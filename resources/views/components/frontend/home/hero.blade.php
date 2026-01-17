{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-neutral-50 via-white to-primary-50 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-50">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(30, 130, 255, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="max-w-4xl mx-auto text-center">
            {{-- Trust Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-neutral-200 rounded-full shadow-sm mb-8">
                <span class="flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-sm text-neutral-600">Trusted by 500+ companies worldwide</span>
            </div>

            {{-- Main Headline --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-neutral-900 leading-tight mb-6">
                Premium Software Solutions<br>
                <span class="text-primary-500">Built in Bangladesh</span>
            </h1>

            {{-- Subheadline --}}
            <p class="text-lg sm:text-xl text-neutral-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                Ready-to-use digital products and custom development services. International quality at competitive rates, delivered by experts who care.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all shadow-lg shadow-primary-500/25 hover:shadow-xl hover:shadow-primary-500/30">
                    Browse Products
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('contact.quote') }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-8 py-4 bg-white text-neutral-700 font-semibold rounded-xl border-2 border-neutral-200 hover:border-primary-500 hover:text-primary-600 transition-all">
                    Get Custom Quote
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </a>
            </div>

            {{-- Stats Row --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900">500+</div>
                    <div class="text-sm text-neutral-500 mt-1">Happy Clients</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900">50+</div>
                    <div class="text-sm text-neutral-500 mt-1">Countries Served</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900">99%</div>
                    <div class="text-sm text-neutral-500 mt-1">Client Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900">24/7</div>
                    <div class="text-sm text-neutral-500 mt-1">Support Available</div>
                </div>
            </div>
        </div>
    </div>
</section>
