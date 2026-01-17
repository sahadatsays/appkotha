<x-layouts.frontend :title="$product->name">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <a href="{{ route('products.index') }}" class="group inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 mb-6 transition-colors">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        All Products
                    </a>
                    <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 dark:text-white mb-6">
                        {{ $product->name }}
                    </h1>
                    <p class="text-xl text-neutral-600 dark:text-neutral-400 mb-8">
                        {{ $product->short_description }}
                    </p>

                    <div class="flex items-baseline gap-4 mb-8">
                        @if($product->price)
                            @if($product->sale_price)
                                <span class="text-4xl font-bold text-neutral-900 dark:text-white">${{ number_format($product->sale_price, 0) }}</span>
                                <span class="text-xl text-neutral-400 line-through">${{ number_format($product->price, 0) }}</span>
                            @else
                                <span class="text-4xl font-bold text-neutral-900 dark:text-white">${{ number_format($product->price, 0) }}</span>
                            @endif
                            <span class="text-neutral-500 dark:text-neutral-400">{{ $product->license_label ?: 'one-time payment' }}</span>
                        @else
                            <span class="text-2xl font-bold text-neutral-900 dark:text-white">Contact for Pricing</span>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @if($product->price)
                            <button
                                type="button"
                                onclick="addToCart({{ $product->id }})"
                                id="add-to-cart-btn"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all btn-shine hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span id="add-to-cart-text">Add to Cart</span>
                            </button>
                            <a href="{{ route('cart.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-semibold rounded-xl border-2 border-neutral-200 dark:border-neutral-700 hover:border-primary-500 dark:hover:border-primary-500 transition-all hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                View Cart
                            </a>
                        @else
                            <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors btn-shine hover:-translate-y-1">
                                Contact for Pricing
                                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        @endif
                        @if($product->demo_url)
                            <a href="{{ $product->demo_url }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-semibold rounded-xl border-2 border-neutral-200 dark:border-neutral-700 hover:border-primary-500 dark:hover:border-primary-500 transition-all hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Live Demo
                            </a>
                        @endif
                    </div>
                </div>

                <div class="aspect-square bg-neutral-100 dark:bg-neutral-800 rounded-2xl flex items-center justify-center hover-lift" data-aos="fade-left" data-aos-delay="200">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-2xl">
                    @else
                        <div class="w-24 h-24 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-primary-600 dark:text-primary-400 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Description --}}
    <section class="py-20 bg-white dark:bg-neutral-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="prose prose-lg dark:prose-invert max-w-none text-neutral-700 dark:text-neutral-300">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </section>

    {{-- Features --}}
    @if($product->features && count($product->features) > 0)
        <section class="py-20 bg-neutral-50 dark:bg-neutral-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-12 text-center" data-aos="fade-up">Features</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($product->features as $index => $feature)
                        <div class="bg-white dark:bg-neutral-800 rounded-xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700 hover-lift" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="font-medium text-neutral-900 dark:text-white">{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Use Cases --}}
    @if($product->use_cases && count($product->use_cases) > 0)
        <section class="py-20 bg-white dark:bg-neutral-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-12 text-center" data-aos="fade-up">Perfect For</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($product->use_cases as $index => $useCase)
                        <div class="text-center p-6 hover-lift" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="w-16 h-16 bg-accent-100 dark:bg-accent-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-accent-600 dark:text-accent-400 animate-float" style="animation-delay: {{ $index * 0.2 }}s" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <p class="font-medium text-neutral-900 dark:text-white">{{ $useCase }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="py-20 bg-neutral-50 dark:bg-neutral-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-8">Related Products</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related) }}" class="group bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700 hover:shadow-elevated dark:hover:border-neutral-600 transition-shadow">
                            <h3 class="font-bold text-neutral-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $related->name }}</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-4">{{ $related->short_description }}</p>
                            @if($related->price)
                                <span class="text-primary-600 dark:text-primary-400 font-semibold">${{ number_format($related->price, 0) }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    @include('components.frontend.home.cta')

    @push('scripts')
    <script>
        function addToCart(productId) {
            const btn = $('#add-to-cart-btn');
            const btnText = $('#add-to-cart-text');
            const originalText = btnText.text();

            btn.prop('disabled', true);
            btnText.text('Adding...');

            $.post('{{ route('cart.add') }}', {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: 1
            })
            .done(function(response) {
                if (response.success) {
                    btnText.text('Added!');

                    // Update cart count in header
                    const cartCount = $('#cart-count');
                    if (cartCount.length) {
                        cartCount.text(response.cart_count).removeClass('hidden');
                    }

                    // Show toast notification
                    showToast('Product added to cart!', 'success');

                    setTimeout(function() {
                        btn.prop('disabled', false);
                        btnText.text(originalText);
                    }, 2000);
                } else {
                    btnText.text('Already in Cart');
                    showToast(response.message || 'Product already in cart', 'info');

                    setTimeout(function() {
                        btn.prop('disabled', false);
                        btnText.text(originalText);
                    }, 2000);
                }
            })
            .fail(function(xhr) {
                btn.prop('disabled', false);
                btnText.text(originalText);
                showToast('Failed to add product to cart', 'error');
            });
        }

        function showToast(message, type = 'success') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            };
            const toast = $(`<div class="fixed bottom-4 right-4 ${colors[type]} text-white px-4 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2">${message}</div>`);
            $('body').append(toast);
            setTimeout(() => toast.fadeOut(300, () => toast.remove()), 3000);
        }
    </script>
    @endpush
</x-layouts.frontend>
