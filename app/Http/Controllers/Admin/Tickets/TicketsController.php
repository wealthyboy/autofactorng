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

        return response()->json([
            'id' => $order->id,
            'invoice' => $order->invoice,
            'customer' => $this->customerName($order),
            'email' => $this->customerEmail($order),
            'status' => $order->status ?: 'Unknown',
            'total' => '₦' . number_format((float) $order->total, 2),
            'date' => optional($order->created_at)->format('d M Y, h:i A'),
            'items' => $order->ordered_products->map(function ($item) {
                $quantity = max(1, (int) $item->quantity);
                $unitPrice = (float) $item->price;

                if ($unitPrice <= 0 && (float) $item->total > 0) {
                    $unitPrice = (float) $item->total / $quantity;
                }

                return [
                    'id' => $item->id,
                    'name' => $item->product_name ?: 'Unnamed product',
                    'quantity' => $quantity,
                    'unit_price' => round($unitPrice, 2),
                    'unit_price_formatted' => '₦' . number_format($unitPrice, 2),
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
        return view('admin.tickets.show', compact('ticket'));
    }

    public function approvePayment(Request $request, Ticket $ticket)
    {
        if (! $ticket->requiresPaymentApproval()) {
            return redirect()->route('admin.tickets.show', $ticket)
                ->with('error', 'Payment approval is not required for this ticket.');
        }

        if ($ticket->approved_at) {
            return redirect()->route('admin.tickets.show', $ticket)
                ->with('success', 'This payment has already been approved.');
        }

        $validated = $request->validate([
            'approval_date' => ['required', 'date'],
        ]);

        $ticket->update([
            'approved_at' => $validated['approval_date'],
            'approved_by' => Auth::id(),
        ]);

        (new Activity)->put('Approved payment for ticket ' . $ticket->ticket_number);

        return redirect()->route('admin.tickets.show', $ticket)
            ->with('success', 'Payment approved successfully.');
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
            $unitPrice = (float) $orderedProduct->price;

            if ($unitPrice <= 0 && (float) $orderedProduct->total > 0) {
                $unitPrice = (float) $orderedProduct->total / $orderedQuantity;
            }

            $selected[] = [
                'ordered_product_id' => $orderedProduct->id,
                'product_name' => $orderedProduct->product_name ?: 'Unnamed product',
                'quantity' => $quantity,
                'unit_price' => round($unitPrice, 2),
                'total' => round($unitPrice * $quantity, 2),
            ];
        }

        return $selected;
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
