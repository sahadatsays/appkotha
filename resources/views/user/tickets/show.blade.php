<x-layouts.frontend :title="$ticket->subject">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="saas-card p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs theme-text-secondary">{{ $ticket->ticket_number }}</p>
                            <h1 class="text-2xl font-bold mt-2">{{ $ticket->subject }}</h1>
                        </div>
                        <a href="{{ route('tickets.index') }}" class="saas-btn-secondary px-3 py-2 text-sm font-semibold">Back</a>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4 mt-6">
                        <div class="rounded-xl border theme-border p-4">
                            <p class="text-xs theme-text-secondary">Status</p>
                            <p class="font-semibold mt-1">{{ $ticket->status->label() }}</p>
                        </div>
                        <div class="rounded-xl border theme-border p-4">
                            <p class="text-xs theme-text-secondary">Priority</p>
                            <p class="font-semibold mt-1">{{ $ticket->priority->label() }}</p>
                        </div>
                        <div class="rounded-xl border theme-border p-4">
                            <p class="text-xs theme-text-secondary">Category</p>
                            <p class="font-semibold mt-1">{{ $ticket->category }}</p>
                        </div>
                    </div>

                    <div class="rounded-xl border theme-border p-5 mt-6">
                        <h2 class="font-semibold">Message</h2>
                        <p class="theme-text-secondary text-sm mt-3 whitespace-pre-line">{{ $ticket->message }}</p>
                    </div>

                    @if($ticket->attachment_path)
                        <div class="rounded-xl border theme-border p-5 mt-4">
                            <h2 class="font-semibold">Attachment</h2>
                            <a class="text-sm theme-text-secondary hover:theme-text-primary mt-2 inline-block" href="{{ asset('storage/'.$ticket->attachment_path) }}" target="_blank" rel="noopener">
                                View uploaded file
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
