<x-layouts.frontend title="Order Confirmation">
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Success Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-neutral-900 dark:text-white mb-4">Thank You for Your Order!</h1>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">
                    Your order <span class="font-semibold text-primary-600 dark:text-primary-400">{{ $order->order_number }}</span> has been received.
                </p>
            </div>

            {{-- Order Status Card --}}
            <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-soft dark:shadow-none dark:border dark:border-neutral-700 overflow-hidden mb-8" data-aos="fade-up" data-aos-delay="100">
                {{-- Status Banner --}}
                @if($order->status === 'completed')
                    <div class="bg-green-500 text-white px-6 py-4 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-semibold">Order Completed - Ready to Download!</span>
                    </div>
                @elseif($order->status === 'pending')
                    <div class="bg-yellow-500 text-white px-6 py-4 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Payment Pending - Awaiting Confirmation</span>
                    </div>
                @elseif($order->status === 'processing')
                    <div class="bg-blue-500 text-white px-6 py-4 flex items-center gap-3">
                        <svg class="w-6 h-6 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="font-semibold">Processing Your Order</span>
                    </div>
                @endif

                <div class="p-6">
                    {{-- Order Details Grid --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-sm font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-2">Order Details</h3>
                            <div class="space-y-2">
                                <p class="text-neutral-900 dark:text-white">
                                    <span class="text-neutral-500 dark:text-neutral-400">Order Number:</span>
                                    <span class="font-semibold">{{ $order->order_number }}</span>
                                </p>
                                <p class="text-neutral-900 dark:text-white">
                                    <span class="text-neutral-500 dark:text-neutral-400">Date:</span>
                                    {{ $order->created_at->format('M d, Y h:i A') }}
                                </p>
                                <p class="text-neutral-900 dark:text-white">
                                    <span class="text-neutral-500 dark:text-neutral-400">Payment Method:</span>
                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-2">Customer Details</h3>
                            <div class="space-y-2">
                                <p class="text-neutral-900 dark:text-white">{{ $order->customer_name }}</p>
                                <p class="text-neutral-600 dark:text-neutral-400">{{ $order->customer_email }}</p>
                                @if($order->customer_phone)
                                    <p class="text-neutral-600 dark:text-neutral-400">{{ $order->customer_phone }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Payment Instructions (for pending orders) --}}
                    @if($order->status === 'pending' && in_array($order->payment_method, ['bank_transfer', 'manual']))
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-6 mb-8">
                            <h3 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Payment Instructions
                            </h3>

                            @if($order->payment_method === 'bank_transfer')
                                <div class="space-y-4 text-sm text-yellow-700 dark:text-yellow-300">
                                    <p>Please transfer <strong>${{ number_format($order->total, 2) }}</strong> to:</p>
                                    <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 space-y-2">
                                        <p><span class="font-medium">Bank:</span> Your Bank Name</p>
                                        <p><span class="font-medium">Account Name:</span> AppKotha</p>
                                        <p><span class="font-medium">Account Number:</span> XXXX-XXXX-XXXX</p>
                                        <p><span class="font-medium">Reference:</span> {{ $order->order_number }}</p>
                                    </div>
                                    <p class="text-xs">Please include your order number as reference. Your order will be processed within 24 hours after payment confirmation.</p>
                                </div>
                            @else
                                <div class="space-y-4 text-sm text-yellow-700 dark:text-yellow-300">
                                    <p>Please send <strong>${{ number_format($order->total, 2) }}</strong> via:</p>
                                    <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 space-y-2">
                                        <p><span class="font-medium">bKash:</span> 01XXXXXXXXX (Personal)</p>
                                        <p><span class="font-medium">Nagad:</span> 01XXXXXXXXX</p>
                                        <p><span class="font-medium">Rocket:</span> 01XXXXXXXXXXX</p>
                                        <p><span class="font-medium">Reference:</span> {{ $order->order_number }}</p>
                                    </div>
                                    <p class="text-xs">After sending payment, please send your transaction ID to <a href="mailto:support@appkotha.com" class="underline">support@appkotha.com</a> with your order number.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Order Items --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex gap-4 p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                    <div class="w-16 h-16 bg-neutral-200 dark:bg-neutral-600 rounded-lg flex-shrink-0 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-semibold text-neutral-900 dark:text-white">{{ $item->product_name }}</h4>
                                                <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ ucfirst(str_replace('-', ' ', $item->license_type)) }} License</p>
                                            </div>
                                            <span class="font-semibold text-neutral-900 dark:text-white">${{ number_format($item->total, 2) }}</span>
                                        </div>

                                        {{-- License Key (if available) --}}
                                        @if($item->license && $order->status === 'completed')
                                            <div class="mt-3 p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                                                <p class="text-xs text-green-600 dark:text-green-400 font-medium mb-1">License Key:</p>
                                                <div class="flex items-center gap-2">
                                                    <code class="text-sm font-mono text-green-800 dark:text-green-200 bg-green-100 dark:bg-green-900/50 px-2 py-1 rounded">
                                                        {{ $item->license->license_key }}
                                                    </code>
                                                    <button
                                                        type="button"
                                                        onclick="copyToClipboard('{{ $item->license->license_key }}')"
                                                        class="p-1 text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200 transition-colors"
                                                        title="Copy license key"
                                                    >
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                @if($item->license->expires_at)
                                                    <p class="text-xs text-green-600 dark:text-green-400 mt-2">
                                                        Valid until: {{ $item->license->expires_at->format('M d, Y') }}
                                                    </p>
                                                @else
                                                    <p class="text-xs text-green-600 dark:text-green-400 mt-2">
                                                        Lifetime License - Never Expires
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Order Total --}}
                    <div class="border-t border-neutral-200 dark:border-neutral-700 pt-6">
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-semibold text-neutral-900 dark:text-white">Total Paid</span>
                            <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Download Section (for completed orders) --}}
            @if($order->status === 'completed')
                <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-soft dark:shadow-none dark:border dark:border-neutral-700 p-6 mb-8" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Your Downloads
                    </h2>

                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            @if($item->license)
                                <div class="flex items-center justify-between p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-neutral-900 dark:text-white">{{ $item->product_name }}</h4>
                                            <p class="text-sm text-neutral-500 dark:text-neutral-400">Ready to download</p>
                                        </div>
                                    </div>
                                    <a
                                        href="{{ route('order.download', ['order' => $order, 'license' => $item->license]) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition-all duration-300"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                        <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>
                                Download links have been sent to <strong>{{ $order->customer_email }}</strong>.
                                @if(auth()->check())
                                    You can also access your downloads from <a href="{{ route('downloads.index') }}" class="underline font-medium">your account</a>.
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
            @endif

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="300">
                @if(auth()->check())
                    <a href="{{ route('downloads.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Go to Downloads
                    </a>
                @endif
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-neutral-200 dark:bg-neutral-700 text-neutral-900 dark:text-white font-semibold rounded-xl hover:bg-neutral-300 dark:hover:bg-neutral-600 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Continue Shopping
                </a>
                <button
                    onclick="window.print()"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 border-2 border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 font-semibold rounded-xl hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-all duration-300"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Print Receipt
                </button>
            </div>

            {{-- Support Note --}}
            <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="400">
                <p class="text-neutral-600 dark:text-neutral-400">
                    Need help? Contact us at
                    <a href="mailto:support@appkotha.com" class="text-primary-600 dark:text-primary-400 hover:underline">support@appkotha.com</a>
                </p>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show toast notification
                const toast = $('<div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">License key copied!</div>');
                $('body').append(toast);
                setTimeout(() => toast.fadeOut(300, () => toast.remove()), 2000);
            });
        }
    </script>
    @endpush
</x-layouts.frontend>
