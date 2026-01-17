<x-layouts.frontend title="Shopping Cart">
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-12" data-aos="fade-up">
                <h1 class="text-4xl font-bold text-neutral-900 dark:text-white mb-4">Shopping Cart</h1>
                <p class="text-neutral-600 dark:text-neutral-400">
                    @if(count($cart['items']) > 0)
                        You have {{ count($cart['items']) }} item(s) in your cart
                    @else
                        Your cart is empty
                    @endif
                </p>
            </div>

            @if(count($cart['items']) > 0)
                <div class="grid lg:grid-cols-3 gap-8">
                    {{-- Cart Items --}}
                    <div class="lg:col-span-2 space-y-4" data-aos="fade-up" data-aos-delay="100">
                        @foreach($cart['items'] as $item)
                            <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700 hover-lift" id="cart-item-{{ $item['id'] }}">
                                <div class="flex gap-6">
                                    {{-- Product Image --}}
                                    <div class="w-24 h-24 bg-neutral-100 dark:bg-neutral-700 rounded-xl flex-shrink-0 overflow-hidden">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Product Info --}}
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <a href="{{ route('products.show', $item['slug']) }}" class="font-semibold text-lg text-neutral-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                                    {{ $item['name'] }}
                                                </a>
                                                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                                                    {{ ucfirst(str_replace('-', ' ', $item['license_type'])) }} License
                                                </p>
                                            </div>

                                            {{-- Remove Button --}}
                                            <button
                                                type="button"
                                                onclick="removeFromCart({{ $item['id'] }})"
                                                class="p-2 text-neutral-400 hover:text-red-500 transition-colors"
                                                aria-label="Remove item"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="mt-4 flex justify-between items-center">
                                            <div class="text-sm text-neutral-500 dark:text-neutral-400">
                                                Qty: 1 (Digital Product)
                                            </div>
                                            <div class="text-right">
                                                @if($item['original_price'] > $item['price'])
                                                    <span class="text-sm text-neutral-400 line-through mr-2">${{ number_format($item['original_price'], 2) }}</span>
                                                @endif
                                                <span class="text-xl font-bold text-neutral-900 dark:text-white">${{ number_format($item['price'], 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Continue Shopping --}}
                        <div class="pt-4">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="lg:col-span-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700 sticky top-24">
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-6">Order Summary</h2>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-neutral-600 dark:text-neutral-400">
                                    <span>Subtotal</span>
                                    <span id="cart-subtotal">${{ number_format($cart['subtotal'], 2) }}</span>
                                </div>

                                @if($cart['discount'] > 0)
                                    <div class="flex justify-between text-green-600 dark:text-green-400">
                                        <span>Discount</span>
                                        <span>-${{ number_format($cart['discount'], 2) }}</span>
                                    </div>
                                @endif

                                @if($cart['tax'] > 0)
                                    <div class="flex justify-between text-neutral-600 dark:text-neutral-400">
                                        <span>Tax</span>
                                        <span>${{ number_format($cart['tax'], 2) }}</span>
                                    </div>
                                @endif

                                <hr class="border-neutral-200 dark:border-neutral-700">

                                <div class="flex justify-between text-lg font-bold text-neutral-900 dark:text-white">
                                    <span>Total</span>
                                    <span id="cart-total">${{ number_format($cart['total'], 2) }}</span>
                                </div>
                            </div>

                            {{-- Checkout Button --}}
                            <a href="{{ route('checkout.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg btn-shine">
                                Proceed to Checkout
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>

                            {{-- Security Note --}}
                            <div class="mt-6 flex items-center gap-3 text-sm text-neutral-500 dark:text-neutral-400">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span>Secure checkout with instant delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty Cart --}}
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="w-24 h-24 bg-neutral-100 dark:bg-neutral-800 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">Your cart is empty</h2>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-8">Looks like you haven't added any products yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg btn-shine">
                        Browse Products
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
    <script>
        function removeFromCart(productId) {
            if (!confirm('Remove this item from cart?')) return;

            $.post('{{ route('cart.remove') }}', {
                _token: '{{ csrf_token() }}',
                product_id: productId
            })
            .done(function(response) {
                if (response.success) {
                    $('#cart-item-' + productId).fadeOut(300, function() {
                        $(this).remove();
                        if (Object.keys(response.cart.items).length === 0) {
                            location.reload();
                        } else {
                            $('#cart-subtotal').text('$' + response.cart.subtotal.toFixed(2));
                            $('#cart-total').text('$' + response.cart.total.toFixed(2));
                            updateCartCount(response.cart.count);
                        }
                    });
                }
            });
        }

        function updateCartCount(count) {
            const badge = $('#cart-count');
            if (badge.length) {
                if (count > 0) {
                    badge.text(count).removeClass('hidden');
                } else {
                    badge.addClass('hidden');
                }
            }
        }
    </script>
    @endpush
</x-layouts.frontend>
