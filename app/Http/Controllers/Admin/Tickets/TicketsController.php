<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Order;
use App\Models\Ticket;
use App\Notifications\TicketCustomerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with(['order.user', 'creator'])->withCount('comments')
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim($request->q);
                $query->where(function ($ticketQuery) use ($term) {
                    $ticketQuery->where('ticket_number', 'like', "%{$term}%")
                        ->orWhere('reason', 'like', "%{$term}%")
                        ->orWhere('category', 'like', "%{$term}%")
                        ->orWhereHas('order', function ($orderQuery) use ($term) {
                            $orderQuery->where('id', $term)->orWhere('invoice', 'like', "%{$term}%");
                        });
                });
            })
            ->latest()->paginate(30)->withQueryString();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create(Request $request)
    {
        return view('admin.tickets.create', ['orderReference' => $request->get('order')]);
    }

    public function orderPreview(Request $request)
    {
        $request->validate(['order' => ['required', 'string', 'max:100']]);
        $order = $this->findOrder($request->order);
        $order->load(['user', 'orderEmail', 'ordered_products']);
        $pricing = $this->orderProductPricing($order);

        return response()->json([
            'id' => $order->id,
            'invoice' => $order->invoice,
            'customer' => $this->customerName($order),
            'email' => $this->customerEmail($order),
            'status' => $order->status ?: 'Unknown',
            'total' => '₦' . number_format((float) $order->total, 2),
            'date' => optional($order->created_at)->format('d M Y, h:i A'),
            'discount' => $pricing['discount_amount'] > 0 ? [
                'label' => $pricing['label'],
                'amount' => $pricing['discount_amount'],
                'amount_formatted' => '-₦' . number_format($pricing['discount_amount'], 2),
                'product_subtotal_formatted' => '₦' . number_format($pricing['paid_subtotal'], 2),
            ] : null,
            'items' => $order->ordered_products->map(function ($item) use ($pricing) {
                $quantity = max(1, (int) $item->quantity);
                $originalUnitPrice = $this->orderedProductUnitPrice($item);
                $unitPrice = round($originalUnitPrice * $pricing['factor'], 2);

                return [
                    'id' => $item->id,
                    'name' => $item->product_name ?: 'Unnamed product',
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'unit_price_formatted' => '₦' . number_format($unitPrice, 2),
                    'original_unit_price' => round($originalUnitPrice, 2),
                    'original_unit_price_formatted' => '₦' . number_format($originalUnitPrice, 2),
                    'discounted' => abs($unitPrice - $originalUnitPrice) >= 0.01,
                    'line_total' => round($unitPrice * $quantity, 2),
                ];
            })->values(),
            'show_url' => route('admin.orders.show', $order->id),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_reference' => ['required', 'string', 'max:100'],
            'department' => ['required', Rule::in(Ticket::DEPARTMENTS)],
            'reason' => ['required', Rule::in(Ticket::REASONS)],
            'category' => ['required', Rule::in(Ticket::CATEGORIES)],
            'additional_information' => ['nullable', 'string', 'max:10000'],
            'items' => ['required', 'array'],
            'account_name' => ['nullable', 'required_if:category,Refund', 'string', 'max:255'],
            'account_number' => ['nullable', 'required_if:category,Refund', 'string', 'max:50'],
            'bank_name' => ['nullable', 'required_if:category,Refund', 'string', 'max:255'],
            'wallet_source' => ['nullable', 'required_if:category,Wallet', Rule::in(Ticket::WALLET_SOURCES)],
            'ticket_amount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $order = $this->findOrder($validated['order_reference']);
        $order->load('ordered_products');

        $selectedItems = $this->selectedItems($order, $request->input('items', []));

        if (empty($selectedItems)) {
            return back()->withErrors(['items' => 'Select at least one item the customer is returning.'])->withInput();
        }

        $requiresEnteredAmount = $validated['category'] === 'Refund'
            || $validated['category'] === 'Wallet'
            || in_array($validated['reason'], ['Over Payment', 'Double Payment'], true);

        if ($requiresEnteredAmount && ! $request->filled('ticket_amount')) {
            return back()->withErrors(['ticket_amount' => 'Amount is required for this ticket.'])->withInput();
        }

        $returnTotal = $requiresEnteredAmount
            ? round((float) $request->input('ticket_amount'), 2)
            : collect($selectedItems)->sum('total');

        $ticket = DB::transaction(function () use ($validated, $order, $selectedItems, $returnTotal) {
            $ticket = Ticket::create([
                'order_id' => $order->id,
                'department' => $validated['department'],
                'reason' => $validated['reason'],
                'category' => $validated['category'],
                'additional_information' => $validated['additional_information'] ?? null,
                'status' => 'Open',
                'return_total' => $returnTotal,
                'account_name' => $validated['category'] === 'Refund' ? $validated['account_name'] : null,
                'account_number' => $validated['category'] === 'Refund' ? $validated['account_number'] : null,
                'bank_name' => $validated['category'] === 'Refund' ? $validated['bank_name'] : null,
                'wallet_source' => $validated['category'] === 'Wallet' ? $validated['wallet_source'] : null,
                'approval_status' => ($validated['category'] === 'Wallet' || $validated['category'] === 'Refund' || in_array($validated['reason'], ['Over Payment', 'Double Payment'], true)) ? 'Pending' : null,
                'created_by' => Auth::id(),
            ]);

            $ticket->update([
                'ticket_number' => 'TKT-' . now()->format('Y') . '-' . str_pad($ticket->id, 6, '0', STR_PAD_LEFT),
            ]);

            foreach ($selectedItems as $item) {
                $ticket->items()->create($item);
            }

            $customerMessage = TicketCustomerNotification::messageFor($ticket, 'created');
            $ticket->comments()->create([
                'comment' => $customerMessage,
                'customer_visible' => true,
                'created_by' => Auth::id(),
            ]);

            return $ticket->load(['order', 'items']);
        });

        $notified = $this->notifyCustomer($ticket, 'created');
        (new Activity)->put('Created ' . strtolower($ticket->category) . ' ticket ' . $ticket->ticket_number . ' for order #' . $order->id);

        return redirect()->route('admin.tickets.show', $ticket)->with(
            'success',
            $notified ? 'Ticket created and the customer was notified.' : 'Ticket created, but no customer email could be sent. Check the order email address.'
        );
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['order.user', 'order.orderEmail', 'order.ordered_products', 'items', 'comments.creator', 'creator', 'approver']);
        $orderPricing = $this->orderProductPricing($ticket->order);

        return view('admin.tickets.show', compact('ticket', 'orderPricing'));
    }

    public function approvePayment(Request $request, Ticket $ticket)
    {
        if (! $ticket->requiresPaymentApproval()) {
            return redirect()->route('admin.tickets.show', $ticket)
                ->with('error', 'Payment approval is not required for this ticket.');
        }

        $validated = $request->validate([
            'approval_status' => ['required', Rule::in(Ticket::APPROVAL_STATUSES)],
            'approval_date' => ['nullable', 'required_if:approval_status,Approved', 'date'],
        ]);

        $status = $validated['approval_status'];
        $updates = [
            'approval_status' => $status,
            'approved_at' => null,
            'approved_by' => null,
        ];

        if ($status === 'Approved') {
            $updates['approved_at'] = $validated['approval_date'];
            $updates['approved_by'] = Auth::id();
        }

        $ticket->update($updates);

        (new Activity)->put($status . ' payment approval for ticket ' . $ticket->ticket_number);

        return redirect()->route('admin.tickets.show', $ticket)
            ->with('success', 'Payment approval updated to ' . $status . '.');
    }

    public function addComment(Request $request, Ticket $ticket)
    {
        $allowedStatuses = $ticket->status === 'Closed'
            ? ['Closed']
            : array_values(array_diff(Ticket::STATUSES, ['Closed']));

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:5000'],
            'status' => ['required', Rule::in($allowedStatuses)],
            'customer_visible' => ['nullable', 'boolean'],
        ]);

        $visible = $request->boolean('customer_visible');
        $comment = $validated['comment'];

        $ticket->update(['status' => $validated['status']]);
        $ticket->comments()->create([
            'comment' => $comment,
            'customer_visible' => $visible,
            'created_by' => Auth::id(),
        ]);

        if ($visible) {
            $this->notifyCustomer($ticket->load('order'), 'update', $comment);
        }

        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Ticket updated.');
    }

    public function close(Ticket $ticket)
    {
        if ($ticket->status === 'Closed') {
            return redirect()->route('admin.tickets.show', $ticket)->with('success', 'This ticket is already closed.');
        }

        $comment = TicketCustomerNotification::messageFor($ticket, 'resolved');

        DB::transaction(function () use ($ticket, $comment) {
            $ticket->update(['status' => 'Closed']);
            $ticket->comments()->create([
                'comment' => $comment,
                'customer_visible' => true,
                'created_by' => Auth::id(),
            ]);
        });

        $notified = $this->notifyCustomer($ticket->load('order'), 'resolved');
        (new Activity)->put('Closed ticket ' . $ticket->ticket_number);

        return redirect()->route('admin.tickets.show', $ticket)->with(
            'success',
            $notified ? 'Ticket closed and the customer was notified.' : 'Ticket closed, but the customer email could not be sent.'
        );
    }

    private function selectedItems(Order $order, array $submittedItems): array
    {
        $selected = [];
        $products = $order->ordered_products->keyBy('id');
        $pricing = $this->orderProductPricing($order);

        foreach ($submittedItems as $orderedProductId => $submitted) {
            if (! is_array($submitted) || empty($submitted['selected'])) {
                continue;
            }

            $orderedProduct = $products->get((int) $orderedProductId);
            if (! $orderedProduct) {
                continue;
            }

            $orderedQuantity = max(1, (int) $orderedProduct->quantity);
            $quantity = max(1, min((int) ($submitted['quantity'] ?? 1), $orderedQuantity));
            $unitPrice = round($this->orderedProductUnitPrice($orderedProduct) * $pricing['factor'], 2);

            $selected[] = [
                'ordered_product_id' => $orderedProduct->id,
                'product_name' => $orderedProduct->product_name ?: 'Unnamed product',
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total' => round($unitPrice * $quantity, 2),
            ];
        }

        return $selected;
    }

    private function orderedProductUnitPrice($orderedProduct): float
    {
        $quantity = max(1, (int) $orderedProduct->quantity);
        $unitPrice = (float) $orderedProduct->price;

        if ($unitPrice <= 0 && (float) $orderedProduct->total > 0) {
            $unitPrice = (float) $orderedProduct->total / $quantity;
        }

        return max(0, $unitPrice);
    }

    private function orderProductPricing(Order $order): array
    {
        $subTotal = (float) $order->ordered_products->sum(function ($item) {
            return $this->orderedProductUnitPrice($item) * max(1, (int) $item->quantity);
        });

        $discountAmount = 0.0;
        $label = null;
        $couponCode = trim((string) $order->coupon);

        if ($couponCode !== '') {
            $voucher = $order->voucher();

            if ($voucher) {
                $voucherAmount = max(0, (float) $voucher->amount);

                if ((bool) $voucher->is_fixed) {
                    $discountAmount = min($subTotal, $voucherAmount);
                    $label = 'Coupon ' . $couponCode . ' (₦' . number_format($voucherAmount, 2) . ' off)';
                } else {
                    $percentage = min(100, $voucherAmount);
                    $discountAmount = min($subTotal, ($percentage / 100) * $subTotal);
                    $label = 'Coupon ' . $couponCode . ' (' . rtrim(rtrim(number_format($percentage, 2, '.', ''), '0'), '.') . '% off)';
                }
            }
        }

        if ($discountAmount <= 0 && (float) $order->discount > 0) {
            $orderDiscount = max(0, (float) $order->discount);

            if ($order->percentage_type === 'percentage') {
                $percentage = min(100, $orderDiscount);
                $discountAmount = min($subTotal, ($percentage / 100) * $subTotal);
                $label = 'Order discount (' . rtrim(rtrim(number_format($percentage, 2, '.', ''), '0'), '.') . '% off)';
            } else {
                $discountAmount = min($subTotal, $orderDiscount);
                $label = 'Order discount (₦' . number_format($orderDiscount, 2) . ' off)';
            }
        }

        $paidSubtotal = max(0, $subTotal - $discountAmount);
        $factor = $subTotal > 0 ? $paidSubtotal / $subTotal : 1;

        return [
            'subtotal' => round($subTotal, 2),
            'discount_amount' => round($discountAmount, 2),
            'paid_subtotal' => round($paidSubtotal, 2),
            'factor' => max(0, min(1, $factor)),
            'label' => $label,
        ];
    }

    private function findOrder(string $reference): Order
    {
        return Order::where('id', trim($reference))->orWhere('invoice', trim($reference))->firstOrFail();
    }

    private function customerEmail(Order $order): ?string
    {
        return $order->email ?: optional($order->orderEmail)->email ?: optional($order->user)->email;
    }

    private function customerName(Order $order): string
    {
        $name = trim((string) $order->fullName());
        if (! $name && $order->user) {
            $name = trim((string) $order->user->fullname());
        }
        return $name ?: 'Valued Customer';
    }

    private function notifyCustomer(Ticket $ticket, string $phase = 'created', ?string $message = null): bool
    {
        $ticket->loadMissing('order.user', 'order.orderEmail');
        $email = $this->customerEmail($ticket->order);

        if (! $email) {
            Log::warning('Ticket customer email unavailable.', ['ticket_id' => $ticket->id]);
            return false;
        }

        try {
            Notification::route('mail', $email)->notify(new TicketCustomerNotification($ticket, $phase, $message));
            return true;
        } catch (\Throwable $exception) {
            Log::error('Ticket customer notification failed.', [
                'ticket_id' => $ticket->id,
                'error' => $exception->getMessage(),
            ]);
            return false;
        }
    }
}
