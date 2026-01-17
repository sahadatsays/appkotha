<x-layouts.frontend title="Our Products">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
                    Digital Products
                </h1>
                <p class="text-xl text-neutral-600">
                    Production-ready software solutions. Purchase once, deploy instantly, own forever. No subscriptions, no hidden fees.
                </p>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    @if($featuredProducts->count() > 0)
        <section class="py-12 bg-primary-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg font-semibold text-primary-900 mb-6">Featured Products</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($featuredProducts as $product)
                        <a href="{{ route('products.show', $product) }}" class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                            <h3 class="font-bold text-neutral-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-neutral-600 mb-4">{{ $product->short_description }}</p>
                            @if($product->price)
                                <span class="text-primary-600 font-semibold">${{ number_format($product->price, 0) }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- All Products --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($products->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-2xl overflow-hidden border border-neutral-200 hover:border-primary-500 hover:shadow-elevated transition-all">
                            <div class="aspect-video bg-neutral-100 flex items-center justify-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-neutral-900 mb-2 group-hover:text-primary-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-neutral-600 text-sm mb-4">
                                    {{ $product->short_description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    @if($product->price)
                                        <span class="text-2xl font-bold text-neutral-900">${{ number_format($product->price, 0) }}</span>
                                    @else
                                        <span class="text-neutral-500">Contact for pricing</span>
                                    @endif
                                    <span class="text-primary-600 font-medium">Learn More →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-neutral-900 mb-4">Products Coming Soon</h3>
                    <p class="text-neutral-600 mb-8 max-w-md mx-auto">
                        We're working on exciting new digital products. Subscribe to our newsletter to be notified when they launch.
                    </p>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                        Get Notified
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
