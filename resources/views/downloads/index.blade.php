<x-layouts.frontend title="My Downloads">
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-12" data-aos="fade-up">
                <h1 class="text-4xl font-bold text-neutral-900 dark:text-white mb-4">My Downloads</h1>
                <p class="text-neutral-600 dark:text-neutral-400">
                    Access all your purchased products and license keys
                </p>
            </div>

            @if($licenses->count() > 0)
                {{-- Downloads Grid --}}
                <div class="grid gap-6" data-aos="fade-up" data-aos-delay="100">
                    @foreach($licenses as $license)
                        <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-soft dark:shadow-none dark:border dark:border-neutral-700 overflow-hidden hover-lift">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                                    {{-- Product Image --}}
                                    <div class="w-full lg:w-32 h-32 bg-neutral-100 dark:bg-neutral-700 rounded-xl flex-shrink-0 overflow-hidden">
                                        @if($license->orderItem->product && $license->orderItem->product->image)
                                            <img src="{{ asset('storage/' . $license->orderItem->product->image) }}" alt="{{ $license->orderItem->product_name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-12 h-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Product Info --}}
                                    <div class="flex-1">
                                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                            <div>
                                                <h2 class="text-xl font-bold text-neutral-900 dark:text-white">
                                                    {{ $license->orderItem->product_name }}
                                                </h2>
                                                <div class="flex flex-wrap gap-2 mt-2">
                                                    <span class="inline-flex items-center px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 text-sm font-medium rounded-full">
                                                        {{ ucfirst(str_replace('-', ' ', $license->license_type)) }} License
                                                    </span>
                                                    @if($license->isExpired())
                                                        <span class="inline-flex items-center px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-sm font-medium rounded-full">
                                                            Expired
                                                        </span>
                                                    @elseif($license->status === 'active')
                                                        <span class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-medium rounded-full">
                                                            Active
                                                        </span>
                                                    @endif
                                                </div>

                                                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-3">
                                                    Purchased: {{ $license->created_at->format('M d, Y') }}
                                                </p>
                                            </div>

                                            {{-- Download Button --}}
                                            <div class="flex-shrink-0">
                                                @if(!$license->isExpired())
                                                    <a
                                                        href="{{ route('downloads.download', $license) }}"
                                                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg"
                                                    >
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                        </svg>
                                                        Download
                                                    </a>
                                                @else
                                                    <span class="inline-flex items-center gap-2 px-6 py-3 bg-neutral-200 dark:bg-neutral-700 text-neutral-500 dark:text-neutral-400 font-semibold rounded-xl cursor-not-allowed">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                                        </svg>
                                                        License Expired
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- License Details Accordion --}}
                                <div class="mt-6 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                                    <button
                                        type="button"
                                        onclick="toggleLicenseDetails({{ $license->id }})"
                                        class="w-full flex items-center justify-between text-left"
                                    >
                                        <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">License Details</span>
                                        <svg class="w-5 h-5 text-neutral-400 transition-transform duration-200" id="license-icon-{{ $license->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>

                                    <div id="license-details-{{ $license->id }}" class="hidden mt-4 space-y-4">
                                        {{-- License Key --}}
                                        <div class="flex items-center gap-3 p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                            <div class="flex-1">
                                                <p class="text-xs text-neutral-500 dark:text-neutral-400 mb-1">License Key</p>
                                                <code class="text-sm font-mono text-neutral-900 dark:text-white">{{ $license->license_key }}</code>
                                            </div>
                                            <button
                                                type="button"
                                                onclick="copyToClipboard('{{ $license->license_key }}')"
                                                class="p-2 text-neutral-400 hover:text-primary-500 transition-colors"
                                                title="Copy license key"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- License Info Grid --}}
                                        <div class="grid md:grid-cols-3 gap-4">
                                            <div class="p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                                <p class="text-xs text-neutral-500 dark:text-neutral-400 mb-1">Activations</p>
                                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">
                                                    {{ $license->current_activations }} / {{ $license->max_activations ?: '∞' }}
                                                </p>
                                            </div>
                                            <div class="p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                                <p class="text-xs text-neutral-500 dark:text-neutral-400 mb-1">Downloads</p>
                                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">
                                                    {{ $license->download_count }}
                                                </p>
                                            </div>
                                            <div class="p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                                <p class="text-xs text-neutral-500 dark:text-neutral-400 mb-1">Expires</p>
                                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">
                                                    {{ $license->expires_at ? $license->expires_at->format('M d, Y') : 'Never' }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Order Info --}}
                                        <div class="flex items-center justify-between p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl">
                                            <div>
                                                <p class="text-xs text-neutral-500 dark:text-neutral-400 mb-1">Order</p>
                                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">{{ $license->orderItem->order->order_number }}</p>
                                            </div>
                                            <a
                                                href="{{ route('checkout.confirmation', $license->orderItem->order) }}"
                                                class="text-sm text-primary-600 dark:text-primary-400 hover:underline"
                                            >
                                                View Order →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $licenses->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="w-24 h-24 bg-neutral-100 dark:bg-neutral-800 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">No downloads yet</h2>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-8">You haven't purchased any products yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg btn-shine">
                        Browse Products
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endif

            {{-- Guest Order Lookup --}}
            <div class="mt-12 bg-white dark:bg-neutral-800 rounded-2xl shadow-soft dark:shadow-none dark:border dark:border-neutral-700 p-8 text-center" data-aos="fade-up">
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Looking for a guest purchase?</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-4">
                    If you made a purchase without an account, you can look it up using your order number.
                </p>
                <a href="{{ route('checkout.lookup') }}" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Look up order by order number
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function toggleLicenseDetails(licenseId) {
            const details = document.getElementById('license-details-' + licenseId);
            const icon = document.getElementById('license-icon-' + licenseId);

            details.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const toast = $('<div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">License key copied!</div>');
                $('body').append(toast);
                setTimeout(() => toast.fadeOut(300, () => toast.remove()), 2000);
            });
        }
    </script>
    @endpush
</x-layouts.frontend>
