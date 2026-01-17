{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-50 dark:opacity-20">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(30, 130, 255, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="max-w-4xl mx-auto text-center">
            {{-- Trust Badge --}}
            @if($siteSettings['hero']['trust_badge_text'] ?? null)
            <div data-aos="fade-down" data-aos-delay="100" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-full shadow-sm mb-8">
                <span class="flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-sm text-neutral-600 dark:text-neutral-300">{{ $siteSettings['hero']['trust_badge_text'] }}</span>
            </div>
            @endif

            {{-- Main Headline --}}
            <h1 data-aos="fade-up" data-aos-delay="200" class="text-4xl sm:text-5xl lg:text-6xl font-bold text-neutral-900 dark:text-white leading-tight mb-6">
                {!! $siteSettings['hero']['headline'] ?? 'Premium Software Solutions<br><span class="text-primary-500 animate-gradient bg-gradient-to-r from-primary-500 via-accent-500 to-primary-500 bg-clip-text text-transparent">Built in Bangladesh</span>' !!}
            </h1>

            {{-- Subheadline --}}
            <p data-aos="fade-up" data-aos-delay="300" class="text-lg sm:text-xl text-neutral-600 dark:text-neutral-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                {{ $siteSettings['hero']['subheadline'] ?? 'Ready-to-use digital products and custom development services. International quality at competitive rates, delivered by experts who care.' }}
            </p>

            {{-- CTA Buttons --}}
            <div data-aos="fade-up" data-aos-delay="400" class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                <a href="{{ $siteSettings['hero']['primary_button_url'] ?? route('products.index') }}" class="btn-shine inline-flex items-center justify-center gap-2 w-full sm:w-auto px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all shadow-lg shadow-primary-500/25 hover:shadow-xl hover:shadow-primary-500/30 hover:-translate-y-1">
                    {{ $siteSettings['hero']['primary_button_text'] ?? 'Browse Products' }}
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ $siteSettings['hero']['secondary_button_url'] ?? route('contact.quote') }}" class="group inline-flex items-center justify-center gap-2 w-full sm:w-auto px-8 py-4 bg-white dark:bg-neutral-800 text-neutral-700 dark:text-neutral-200 font-semibold rounded-xl border-2 border-neutral-200 dark:border-neutral-700 hover:border-primary-500 dark:hover:border-primary-500 hover:text-primary-600 dark:hover:text-primary-400 transition-all hover:-translate-y-1">
                    {{ $siteSettings['hero']['secondary_button_text'] ?? 'Get Custom Quote' }}
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </a>
            </div>

            {{-- Stats Row --}}
            @if(isset($siteSettings['stats']))
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
                @if($siteSettings['stats']['clients_count'] ?? null)
                <div data-aos="zoom-in" data-aos-delay="500" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white" data-counter="{{ $siteSettings['stats']['clients_count'] }}" data-suffix="{{ $siteSettings['stats']['clients_suffix'] ?? '+' }}">0</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">{{ $siteSettings['stats']['clients_label'] ?? 'Happy Clients' }}</div>
                </div>
                @endif
                @if($siteSettings['stats']['countries_count'] ?? null)
                <div data-aos="zoom-in" data-aos-delay="600" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white" data-counter="{{ $siteSettings['stats']['countries_count'] }}" data-suffix="{{ $siteSettings['stats']['countries_suffix'] ?? '+' }}">0</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">{{ $siteSettings['stats']['countries_label'] ?? 'Countries Served' }}</div>
                </div>
                @endif
                @if($siteSettings['stats']['satisfaction_count'] ?? null)
                <div data-aos="zoom-in" data-aos-delay="700" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white" data-counter="{{ $siteSettings['stats']['satisfaction_count'] }}" data-suffix="{{ $siteSettings['stats']['satisfaction_suffix'] ?? '%' }}">0</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">{{ $siteSettings['stats']['satisfaction_label'] ?? 'Client Satisfaction' }}</div>
                </div>
                @endif
                @if($siteSettings['stats']['support_text'] ?? null)
                <div data-aos="zoom-in" data-aos-delay="800" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white">{{ $siteSettings['stats']['support_text'] }}</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">{{ $siteSettings['stats']['support_label'] ?? 'Support Available' }}</div>
                </div>
                @endif
            </div>
            @else
            {{-- Default stats if no settings --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
                <div data-aos="zoom-in" data-aos-delay="500" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white" data-counter="500" data-suffix="+">0</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Happy Clients</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="600" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white" data-counter="50" data-suffix="+">0</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Countries Served</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="700" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white" data-counter="99" data-suffix="%">0</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Client Satisfaction</div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="800" class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white">24/7</div>
                    <div class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Support Available</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
