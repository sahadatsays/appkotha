<x-layouts.frontend title="Our Services">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 dark:text-white mb-6">
                    Custom Development Services
                </h1>
                <p class="text-xl text-neutral-600 dark:text-neutral-400">
                    From MVPs to enterprise solutions, our senior developers bring your vision to life with international-quality code.
                </p>
            </div>
        </div>
    </section>

    {{-- Services Grid --}}
    <section class="py-20 bg-white dark:bg-neutral-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($services->count() > 0)
                <div class="grid md:grid-cols-2 gap-8">
                    @foreach($services as $service)
                        <a href="{{ route('services.show', $service) }}" class="group bg-white dark:bg-neutral-800 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-700 hover:border-primary-500 dark:hover:border-primary-400 hover:shadow-elevated transition-all">
                            <div class="w-14 h-14 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-7 h-7 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                {{ $service->name }}
                            </h3>
                            <p class="text-neutral-600 dark:text-neutral-400 mb-6">
                                {{ $service->short_description }}
                            </p>
                            @if($service->starting_price)
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                    Starting from <span class="text-neutral-900 dark:text-white font-semibold">${{ number_format($service->starting_price, 0) }}</span>
                                </p>
                            @endif
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">Our Services</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-8 max-w-md mx-auto">
                        We offer web development, mobile app development, API development, and more. Contact us to discuss your project.
                    </p>
                    <a href="{{ route('contact.quote') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                        Get a Quote
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Process --}}
    @include('components.frontend.home.process')

    {{-- CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
