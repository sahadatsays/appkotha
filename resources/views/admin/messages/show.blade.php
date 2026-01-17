<x-admin-layout>
    <x-slot name="title">Message from {{ $message->name }}</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.messages.index') }}" class="text-gray-500 hover:text-gray-700">Messages</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">View Message</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Message Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Original Message -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">{{ $message->subject ?: 'No Subject' }}</h3>
                        @php
                            $typeColors = [
                                'general' => 'bg-gray-100 text-gray-800',
                                'quote' => 'bg-blue-100 text-blue-800',
                                'demo' => 'bg-purple-100 text-purple-800',
                                'support' => 'bg-orange-100 text-orange-800',
                            ];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeColors[$message->message_type] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($message->message_type ?? 'general') }}
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">{{ $message->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <div class="p-5">
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reply to {{ $message->name }}</h3>

                @if($message->is_replied)
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-green-700">Replied on {{ $message->replied_at->format('M d, Y h:i A') }}</span>
                        </div>
                        @if($message->notes)
                            <div class="mt-2 text-sm text-gray-600">
                                <strong>Previous Reply:</strong>
                                <p class="mt-1">{{ $message->notes }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <input type="text" name="subject" id="subject" value="Re: {{ $message->subject }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label for="reply_message" class="block text-sm font-medium text-gray-700">Message *</label>
                            <textarea name="reply_message" id="reply_message" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                placeholder="Type your reply here..."></textarea>
                            @error('reply_message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Send Reply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Sender Info -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Sender</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $message->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $message->email }}" class="text-indigo-600 hover:text-indigo-800">
                                {{ $message->email }}
                            </a>
                        </dd>
                    </div>
                    @if($message->phone)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="tel:{{ $message->phone }}" class="text-indigo-600 hover:text-indigo-800">
                                    {{ $message->phone }}
                                </a>
                            </dd>
                        </div>
                    @endif
                    @if($message->company)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $message->company }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Status -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Status</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Read Status</span>
                        @if($message->is_read)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Read</span>
                        @else
                            <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                                    Mark as Read
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Reply Status</span>
                        @if($message->is_replied)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Replied</span>
                        @else
                            <form action="{{ route('admin.messages.mark-replied', $message) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                                    Mark as Replied
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="mailto:{{ $message->email }}" class="block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 text-center">
                        Open in Email Client
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this message?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700">
                            Delete Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Metadata -->
            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Metadata</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Received</dt>
                        <dd class="text-gray-900">{{ $message->created_at->format('M d, Y') }}</dd>
                    </div>
                    @if($message->ip_address)
                        <div class="flex justify-between">
                            <dt class="text-gray-500">IP Address</dt>
                            <dd class="text-gray-900 font-mono text-xs">{{ $message->ip_address }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</x-admin-layout>
