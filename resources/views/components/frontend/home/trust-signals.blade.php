{{-- Trust Signals Section --}}
<section class="py-10 sm:py-12 bg-white dark:bg-neutral-900 border-y border-neutral-100 dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-8" data-aos="fade-up">
            {{ __('frontend.home.trusted_by') }}
        </p>

        @php
            $bangladeshiCompanies = collect([
                ['name' => 'bKash', 'mark' => 'BK'],
                ['name' => 'Pathao', 'mark' => 'PT'],
                ['name' => 'Daraz BD', 'mark' => 'DZ'],
                ['name' => 'Grameenphone', 'mark' => 'GP'],
                ['name' => 'Robi', 'mark' => 'RB'],
                ['name' => 'BRAC Bank', 'mark' => 'BB'],
                ['name' => 'Aarong', 'mark' => 'AR'],
                ['name' => 'Shwapno', 'mark' => 'SW'],
            ])->shuffle()->take(6);
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4" data-aos="fade-up" data-aos-delay="100">
            @foreach($bangladeshiCompanies as $company)
                <div class="h-14 sm:h-16 px-3 sm:px-4 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 flex items-center gap-3 hover:border-primary-300 dark:hover:border-primary-600 hover:shadow-md transition-all duration-300">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 text-xs font-bold flex items-center justify-center shrink-0">
                        {{ $company['mark'] }}
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-neutral-700 dark:text-neutral-300 leading-tight">
                        {{ $company['name'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>
