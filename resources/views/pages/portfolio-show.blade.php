<x-layouts.frontend :title="$caseStudy->title">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Back to Portfolio
                </a>
                @if($caseStudy->client_industry)
                    <span class="inline-block px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-sm font-medium rounded-full mb-4">
                        {{ $caseStudy->client_industry }}
                    </span>
                @endif
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 dark:text-white mb-6">
                    {{ $caseStudy->title }}
                </h1>
                <p class="text-xl text-neutral-600 dark:text-neutral-400">
                    {{ $caseStudy->description }}
                </p>
            </div>
        </div>
    </section>

    {{-- Featured Image --}}
    <section class="pb-20 bg-white dark:bg-neutral-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="aspect-video bg-neutral-200 dark:bg-neutral-800 rounded-2xl flex items-center justify-center overflow-hidden">
                @if($caseStudy->featured_image)
                    <img src="{{ asset('storage/' . $caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}" class="w-full h-full object-cover">
                @else
                    <span class="text-neutral-400">Project Image</span>
                @endif
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-20 bg-white dark:bg-neutral-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-16">
                {{-- Challenge --}}
                @if($caseStudy->challenge)
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">The Challenge</h2>
                        <div class="prose prose-lg dark:prose-invert text-neutral-600 dark:text-neutral-400">
                            {!! nl2br(e($caseStudy->challenge)) !!}
                        </div>
                    </div>
                @endif

                {{-- Solution --}}
                @if($caseStudy->solution)
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">Our Solution</h2>
                        <div class="prose prose-lg dark:prose-invert text-neutral-600 dark:text-neutral-400">
                            {!! nl2br(e($caseStudy->solution)) !!}
                        </div>
                    </div>
                @endif

                {{-- Tech Stack --}}
                @if($caseStudy->tech_stack && count($caseStudy->tech_stack) > 0)
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">Technologies Used</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($caseStudy->tech_stack as $tech)
                                <span class="px-4 py-2 bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 rounded-lg text-sm font-medium">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Results --}}
                @if($caseStudy->metrics && count($caseStudy->metrics) > 0)
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-6">Results</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach($caseStudy->metrics as $metric)
                                <div class="bg-primary-50 dark:bg-primary-900/20 rounded-xl p-6 text-center">
                                    <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-2">{{ $metric['value'] ?? '' }}</div>
                                    <div class="text-sm text-neutral-600 dark:text-neutral-400">{{ $metric['label'] ?? '' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Testimonial --}}
                @if($caseStudy->testimonial_quote)
                    <div class="bg-neutral-900 dark:bg-neutral-800 rounded-2xl p-8">
                        <svg class="w-10 h-10 text-neutral-700 dark:text-neutral-600 mb-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-xl text-white mb-6">"{{ $caseStudy->testimonial_quote }}"</p>
                        @if($caseStudy->testimonial_author)
                            <div>
                                <p class="font-semibold text-white">{{ $caseStudy->testimonial_author }}</p>
                                @if($caseStudy->testimonial_title)
                                    <p class="text-neutral-400">{{ $caseStudy->testimonial_title }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Related Projects --}}
    @if($relatedStudies->count() > 0)
        <section class="py-20 bg-neutral-50 dark:bg-neutral-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-8">More Projects</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedStudies as $study)
                        <a href="{{ route('portfolio.show', $study) }}" class="group bg-white dark:bg-neutral-800 rounded-2xl overflow-hidden shadow-soft dark:shadow-none dark:border dark:border-neutral-700 hover:shadow-elevated dark:hover:border-neutral-600 transition-shadow">
                            <div class="aspect-video bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center">
                                @if($study->featured_image)
                                    <img src="{{ asset('storage/' . $study->featured_image) }}" alt="{{ $study->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-neutral-400">Project Image</span>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-neutral-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $study->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
