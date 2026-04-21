<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportTicketRequest;
use App\Models\SupportTicket;
use App\SupportTicketPriority;
use App\SupportTicketStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupportTicketController extends Controller
{
    public function index(): View
    {
        $tickets = auth()->user()
            ->supportTickets()
            ->latest()
            ->paginate(10);

        $ticketSummary = auth()->user()
            ->supportTickets()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('user.tickets.index', [
            'tickets' => $tickets,
            'ticketSummary' => $ticketSummary,
        ]);
    }

    public function create(): View
    {
        return view('user.tickets.create', [
            'priorities' => SupportTicketPriority::cases(),
            'categories' => [
                'Technical Issue',
                'Billing',
                'Feature Request',
                'Account',
                'General Inquiry',
            ],
        ]);
    }

    public function store(StoreSupportTicketRequest $request): RedirectResponse
    {
        $payload = $request->validated();

        $attachmentPath = $request->file('attachment')?->store('support-attachments', 'public');

        auth()->user()->supportTickets()->create([
            'subject' => $payload['subject'],
            'category' => $payload['category'],
            'priority' => SupportTicketPriority::from($payload['priority']),
            'status' => SupportTicketStatus::Open,
            'message' => $payload['message'],
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()->route('tickets.index')->with('status', 'Support ticket created successfully.');
    }

    public function show(SupportTicket $ticket): View
    {
        abort_unless(auth()->id() === $ticket->user_id, 403);

        return view('user.tickets.show', [
            'ticket' => $ticket,
        ]);
    }
}
