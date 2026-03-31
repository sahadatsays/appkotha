{{-- FAQ Section --}}
@php
    $faqs = \App\Models\Faq::published()
        ->featured()
        ->ordered()
        ->take(10)
        ->get();
@endphp

@if($faqs->count() > 0)
<section class="py-20 lg:py-28 bg-white dark:bg-neutral-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 dark:text-white mb-4">
                {{ __('frontend.home.faq_title') }}
            </h2>
            <p class="text-lg text-neutral-600 dark:text-neutral-400">
                {{ __('frontend.home.faq_subtitle') }}
            </p>
        </div>

        {{-- FAQ Accordion --}}
        <div class="space-y-4" x-data="{ openIndex: null }">
            @foreach($faqs as $index => $faq)
                <div data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}" class="border border-neutral-200 dark:border-neutral-700 rounded-xl overflow-hidden hover:border-primary-300 dark:hover:border-primary-700 transition-colors" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-6 text-left hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors">
                        <span class="font-semibold text-neutral-900 dark:text-white pr-4">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-neutral-500 dark:text-neutral-400 shrink-0 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6">
                        <p class="text-neutral-600 dark:text-neutral-400 leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Contact CTA --}}
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <p class="text-neutral-600 dark:text-neutral-400 mb-4">{{ __('frontend.home.still_have_questions') }}</p>
            <a href="{{ route('contact.index') }}" class="group inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-medium hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                {{ __('frontend.home.contact_team') }}
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
