<x-layouts.frontend :title="$product->name">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        All Products
                    </a>
                    <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
                        {{ $product->name }}
                    </h1>
                    <p class="text-xl text-neutral-600 mb-8">
                        {{ $product->short_description }}
                    </p>

                    <div class="flex items-baseline gap-4 mb-8">
                        @if($product->price)
                            <span class="text-4xl font-bold text-neutral-900">${{ number_format($product->price, 0) }}</span>
                            <span class="text-neutral-500">one-time payment</span>
                        @else
                            <span class="text-2xl font-bold text-neutral-900">Contact for Pricing</span>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                            Purchase Now
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-neutral-700 font-semibold rounded-xl border-2 border-neutral-200 hover:border-primary-500 transition-colors">
                            Request Demo
                        </a>
                    </div>
                </div>

                <div class="aspect-square bg-neutral-100 rounded-2xl flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-2xl">
                    @else
                        <div class="w-24 h-24 bg-primary-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Description --}}
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </section>

    {{-- Features --}}
    @if($product->features && count($product->features) > 0)
        <section class="py-20 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-neutral-900 mb-12 text-center">Features</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($product->features as $feature)
                        <div class="bg-white rounded-xl p-6 shadow-soft">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <p class="font-medium text-neutral-900">{{ $feature }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Use Cases --}}
    @if($product->use_cases && count($product->use_cases) > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-neutral-900 mb-12 text-center">Perfect For</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($product->use_cases as $useCase)
                        <div class="text-center p-6">
                            <div class="w-16 h-16 bg-accent-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <p class="font-medium text-neutral-900">{{ $useCase }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="py-20 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-8">Related Products</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related) }}" class="group bg-white rounded-2xl p-6 shadow-soft hover:shadow-elevated transition-shadow">
                            <h3 class="font-bold text-neutral-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $related->name }}</h3>
                            <p class="text-sm text-neutral-600 mb-4">{{ $related->short_description }}</p>
                            @if($related->price)
                                <span class="text-primary-600 font-semibold">${{ number_format($related->price, 0) }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
