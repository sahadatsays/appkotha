<x-layouts.frontend title="Support Tickets">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="space-y-6">
                    <div class="saas-card p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold">Support Tickets</h1>
                                <p class="theme-text-secondary text-sm mt-1">Track status and responses for your requests.</p>
                            </div>
                            <a href="{{ route('tickets.create') }}" class="saas-btn-primary px-4 py-2 text-sm font-semibold">Create Ticket</a>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach(['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed'] as $statusKey => $statusLabel)
                            <div class="saas-card p-4">
                                <p class="text-xs theme-text-secondary">{{ $statusLabel }}</p>
                                <p class="text-2xl font-bold mt-2">{{ $ticketSummary[$statusKey] ?? 0 }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="saas-card p-6">
                        @if($tickets->isEmpty())
                            <div class="rounded-xl border theme-border p-8 text-center">
                                <p class="font-semibold">No tickets found</p>
                                <p class="theme-text-secondary text-sm mt-2">Create your first ticket to contact support.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="text-left theme-text-secondary border-b theme-border">
                                            <th class="py-3 pr-3">Ticket</th>
                                            <th class="py-3 pr-3">Subject</th>
                                            <th class="py-3 pr-3">Priority</th>
                                            <th class="py-3 pr-3">Status</th>
                                            <th class="py-3">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                            <tr class="border-b theme-border">
                                                <td class="py-3 pr-3">
                                                    <a href="{{ route('tickets.show', $ticket) }}" class="hover:underline">{{ $ticket->ticket_number }}</a>
                                                </td>
                                                <td class="py-3 pr-3">{{ $ticket->subject }}</td>
                                                <td class="py-3 pr-3">{{ $ticket->priority->label() }}</td>
                                                <td class="py-3 pr-3">{{ $ticket->status->label() }}</td>
                                                <td class="py-3">{{ $ticket->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6">
                                {{ $tickets->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
