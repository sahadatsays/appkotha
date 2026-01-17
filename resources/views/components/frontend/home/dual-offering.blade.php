{{-- Dual Offering Section (Products & Services) --}}
@props(['products', 'services'])

<section class="py-20 lg:py-28 bg-neutral-50 dark:bg-neutral-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white mb-4">
                Two Ways to Work With Us
            </h2>
            <p class="text-lg text-neutral-600 dark:text-neutral-400">
                Choose ready-to-deploy products for instant solutions, or partner with us for custom development tailored to your needs.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Products Card --}}
            <div class="bg-white dark:bg-neutral-800 rounded-3xl p-8 lg:p-10 shadow-soft border border-neutral-100 dark:border-neutral-700 hover:shadow-elevated transition-shadow">
                <div class="w-14 h-14 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Digital Products</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-8">
                    Production-ready software solutions. Purchase once, deploy instantly, own forever. No recurring fees, lifetime updates included.
                </p>

                {{-- Featured Products --}}
                @if($products->count() > 0)
                    <div class="space-y-4 mb-8">
                        @foreach($products->take(3) as $product)
                            <a href="{{ route('products.show', $product) }}" class="flex items-center gap-4 p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors group">
                                <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 truncate">{{ $product->name }}</h4>
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400 truncate">{{ $product->short_description }}</p>
                                </div>
                                @if($product->price)
                                    <span class="text-primary-600 dark:text-primary-400 font-semibold">${{ number_format($product->price, 0) }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 rounded-xl">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-900">SaaS Starter Kit</h4>
                                <p class="text-sm text-neutral-500">Launch your SaaS in days, not months</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 rounded-xl">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-900">E-Commerce Platform</h4>
                                <p class="text-sm text-neutral-500">Complete online store solution</p>
                            </div>
                        </div>
                    </div>
                @endif

                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 w-full justify-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                    View All Products
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Services Card --}}
            <div class="bg-white dark:bg-neutral-800 rounded-3xl p-8 lg:p-10 shadow-soft border border-neutral-100 dark:border-neutral-700 hover:shadow-elevated transition-shadow">
                <div class="w-14 h-14 bg-accent-100 dark:bg-accent-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Custom Development</h3>
                <p class="text-neutral-600 dark:text-neutral-400 mb-8">
                    Bespoke solutions built for your unique requirements. From MVPs to enterprise systems, we bring your vision to life.
                </p>

                {{-- Services List --}}
                @if($services->count() > 0)
                    <div class="space-y-4 mb-8">
                        @foreach($services->take(4) as $service)
                            <a href="{{ route('services.show', $service) }}" class="flex items-center gap-4 p-4 bg-neutral-50 dark:bg-neutral-700/50 rounded-xl hover:bg-accent-50 dark:hover:bg-accent-900/20 transition-colors group">
                                <div class="w-12 h-12 bg-accent-100 dark:bg-accent-900/30 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-neutral-900 dark:text-white group-hover:text-accent-600 dark:group-hover:text-accent-400">{{ $service->name }}</h4>
                                    <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $service->short_description }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 rounded-xl">
                            <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-900">Web Application Development</h4>
                                <p class="text-sm text-neutral-500">Custom web solutions</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 rounded-xl">
                            <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-900">Mobile App Development</h4>
                                <p class="text-sm text-neutral-500">iOS & Android apps</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 rounded-xl">
                            <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-900">API Development</h4>
                                <p class="text-sm text-neutral-500">Robust backend solutions</p>
                            </div>
                        </div>
                    </div>
                @endif

                <a href="{{ route('contact.quote') }}" class="inline-flex items-center gap-2 w-full justify-center px-6 py-3 bg-accent-500 text-white font-semibold rounded-xl hover:bg-accent-600 transition-colors">
                    Get Free Quote
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
