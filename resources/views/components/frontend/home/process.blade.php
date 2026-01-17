{{-- Our Process Section --}}
<section class="py-20 lg:py-28 bg-white dark:bg-neutral-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white mb-4">
                How We Work
            </h2>
            <p class="text-lg text-neutral-600 dark:text-neutral-400">
                A proven process that delivers results. From initial consultation to ongoing support, we're with you every step of the way.
            </p>
        </div>

        {{-- Process Steps --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Step 1 --}}
            <div class="relative">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-primary-500 rounded-2xl flex items-center justify-center mb-6 relative">
                        <span class="text-white text-2xl font-bold">1</span>
                        <div class="absolute -right-4 top-1/2 -translate-y-1/2 hidden lg:block">
                            <svg class="w-8 h-8 text-neutral-200 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Discovery</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm">
                        We listen to understand your goals, challenges, and requirements in detail.
                    </p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="relative">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-primary-500 rounded-2xl flex items-center justify-center mb-6 relative">
                        <span class="text-white text-2xl font-bold">2</span>
                        <div class="absolute -right-4 top-1/2 -translate-y-1/2 hidden lg:block">
                            <svg class="w-8 h-8 text-neutral-200 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Planning</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm">
                        Detailed proposal with timeline, milestones, and transparent pricing.
                    </p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="relative">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-primary-500 rounded-2xl flex items-center justify-center mb-6 relative">
                        <span class="text-white text-2xl font-bold">3</span>
                        <div class="absolute -right-4 top-1/2 -translate-y-1/2 hidden lg:block">
                            <svg class="w-8 h-8 text-neutral-200 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Development</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm">
                        Agile development with weekly updates and continuous feedback loops.
                    </p>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="relative">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-primary-500 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-white text-2xl font-bold">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-2">Launch & Support</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 text-sm">
                        Smooth deployment and ongoing maintenance to ensure long-term success.
                    </p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-neutral-900 dark:bg-white text-white dark:text-neutral-900 font-semibold rounded-xl hover:bg-neutral-800 dark:hover:bg-neutral-100 transition-colors">
                Start Your Project
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
