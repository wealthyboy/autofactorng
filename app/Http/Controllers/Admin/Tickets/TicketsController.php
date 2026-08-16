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
        $tickets = Ticket::with(['order', 'creator'])->withCount('comments')
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim($request->q);
                $query->where(function ($ticketQuery) use ($term) {
                    $ticketQuery->where('ticket_number', 'like', "%{$term}%")
                        ->orWhere('reason', 'like', "%{$term}%")
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
            'customer' => trim($order->fullName()) ?: optional($order->user)->fullname(),
            'email' => $this->customerEmail($order),
            'status' => $order->status ?: 'Unknown',
            'total' => '₦' . number_format((float) $order->total, 2),
            'date' => optional($order->created_at)->format('d M Y, h:i A'),
            'items' => $order->ordered_products->map(function ($item) {
                return ['name' => $item->product_name ?: 'Unnamed product', 'quantity' => (int) $item->quantity];
            })->values(),
            'show_url' => route('admin.orders.show', $order->id),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_reference' => ['required', 'string', 'max:100'],
            'reason' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:5000'],
        ]);
        $order = $this->findOrder($validated['order_reference']);

        $ticket = DB::transaction(function () use ($validated, $order) {
            $ticket = Ticket::create([
                'order_id' => $order->id,
                'reason' => $validated['reason'],
                'status' => 'Open',
                'created_by' => Auth::id(),
            ]);
            $ticket->update(['ticket_number' => 'TKT-' . now()->format('Y') . '-' . str_pad($ticket->id, 6, '0', STR_PAD_LEFT)]);
            $ticket->comments()->create([
                'comment' => $validated['comment'],
                'customer_visible' => true,
                'created_by' => Auth::id(),
            ]);
            return $ticket->load('order');
        });

        $notified = $this->notifyCustomer($ticket, $validated['comment']);
        (new Activity)->put('Created ticket ' . $ticket->ticket_number . ' for order #' . $order->id);

        return redirect()->route('admin.tickets.show', $ticket)->with(
            'success',
            $notified ? 'Ticket created and the customer was notified.' : 'Ticket created, but no customer email could be sent. Check the order email address.'
        );
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['order.user', 'order.orderEmail', 'order.ordered_products', 'comments.creator', 'creator']);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function addComment(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:5000'],
            'status' => ['required', Rule::in(Ticket::STATUSES)],
            'customer_visible' => ['nullable', 'boolean'],
        ]);
        $visible = $request->boolean('customer_visible');
        $ticket->update(['status' => $validated['status']]);
        $ticket->comments()->create([
            'comment' => $validated['comment'],
            'customer_visible' => $visible,
            'created_by' => Auth::id(),
        ]);

        if ($visible) {
            $this->notifyCustomer($ticket->load('order'), $validated['comment']);
        }

        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Ticket updated.');
    }

    private function findOrder(string $reference): Order
    {
        return Order::where('id', trim($reference))->orWhere('invoice', trim($reference))->firstOrFail();
    }

    private function customerEmail(Order $order): ?string
    {
        return $order->email ?: optional($order->orderEmail)->email ?: optional($order->user)->email;
    }

    private function notifyCustomer(Ticket $ticket, string $comment): bool
    {
        $email = $this->customerEmail($ticket->order);
        if (! $email) {
            Log::warning('Ticket customer email unavailable.', ['ticket_id' => $ticket->id]);
            return false;
        }

        try {
            Notification::route('mail', $email)->notify(new TicketCustomerNotification($ticket, $comment));
            return true;
        } catch (\Throwable $exception) {
            Log::error('Ticket customer notification failed.', ['ticket_id' => $ticket->id, 'error' => $exception->getMessage()]);
            return false;
        }
    }
}
