<x-layouts.frontend title="Pricing">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
                    Transparent Pricing
                </h1>
                <p class="text-xl text-neutral-600">
                    Choose ready-made products for instant solutions, or get a custom quote for your unique requirements.
                </p>
            </div>
        </div>
    </section>

    {{-- Products Pricing --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-neutral-900 mb-12 text-center">Digital Products</h2>

            @if($products->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl p-8 border border-neutral-200 hover:border-primary-500 hover:shadow-elevated transition-all">
                            <h3 class="text-xl font-bold text-neutral-900 mb-3">{{ $product->name }}</h3>
                            <p class="text-neutral-600 mb-6">{{ $product->short_description }}</p>

                            @if($product->price)
                                <div class="mb-6">
                                    <span class="text-4xl font-bold text-neutral-900">${{ number_format($product->price, 0) }}</span>
                                    <span class="text-neutral-500">one-time</span>
                                </div>
                            @endif

                            @if($product->features)
                                <ul class="space-y-3 mb-8">
                                    @foreach(array_slice($product->features, 0, 5) as $feature)
                                        <li class="flex items-center gap-3 text-neutral-600">
                                            <svg class="w-5 h-5 text-primary-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <a href="{{ route('products.show', $product) }}" class="block w-full text-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                                Learn More
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-neutral-500">Products coming soon. Contact us for more information.</p>
            @endif
        </div>
    </section>

    {{-- Custom Development Pricing --}}
    <section class="py-20 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-neutral-900 mb-6 text-center">Custom Development</h2>
            <p class="text-lg text-neutral-600 text-center mb-12 max-w-2xl mx-auto">
                Every project is unique. We provide custom quotes based on your specific requirements and scope.
            </p>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white rounded-2xl p-8 border border-neutral-200">
                    <h3 class="text-xl font-bold text-neutral-900 mb-4">MVP Development</h3>
                    <p class="text-neutral-600 mb-6">Perfect for startups looking to validate their idea quickly.</p>
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-neutral-900">From $5,000</span>
                    </div>
                    <ul class="space-y-3 text-sm text-neutral-600">
                        <li>• 4-8 weeks timeline</li>
                        <li>• Core features only</li>
                        <li>• Single platform</li>
                        <li>• Basic support included</li>
                    </ul>
                </div>
                <div class="bg-white rounded-2xl p-8 border-2 border-primary-500 relative">
                    <span class="absolute top-0 right-0 bg-primary-500 text-white text-xs font-semibold px-3 py-1 rounded-bl-xl rounded-tr-xl">Popular</span>
                    <h3 class="text-xl font-bold text-neutral-900 mb-4">Full Product</h3>
                    <p class="text-neutral-600 mb-6">Complete solution with all the features you need to succeed.</p>
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-neutral-900">From $15,000</span>
                    </div>
                    <ul class="space-y-3 text-sm text-neutral-600">
                        <li>• 8-16 weeks timeline</li>
                        <li>• Full feature set</li>
                        <li>• Multi-platform support</li>
                        <li>• Priority support included</li>
                    </ul>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-neutral-200">
                    <h3 class="text-xl font-bold text-neutral-900 mb-4">Enterprise</h3>
                    <p class="text-neutral-600 mb-6">Complex systems for large organizations with specific needs.</p>
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-neutral-900">Custom Quote</span>
                    </div>
                    <ul class="space-y-3 text-sm text-neutral-600">
                        <li>• Flexible timeline</li>
                        <li>• Unlimited features</li>
                        <li>• Dedicated team</li>
                        <li>• 24/7 support available</li>
                    </ul>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('contact.quote') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                    Get Custom Quote
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    @include('components.frontend.home.faq')
</x-layouts.frontend>
