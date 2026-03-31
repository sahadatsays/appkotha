@props(['member'])

<article class="group relative overflow-hidden rounded-2xl border border-primary-100 bg-white shadow-md transition-all duration-300 hover:shadow-xl dark:border-primary-900/40 dark:bg-neutral-900">
    <div class="absolute right-4 top-4 z-10 rounded-full bg-primary-500 px-3 py-1 text-xs font-semibold text-white">
        Featured
    </div>

    <div class="grid md:grid-cols-2">
        <div class="overflow-hidden">
            <img
                src="{{ $member->profile_image }}"
                alt="{{ $member->name }}"
                loading="lazy"
                class="h-72 w-full object-cover transition-transform duration-500 group-hover:scale-105 md:h-full"
            >
        </div>

        <div class="p-6 lg:p-8">
            <h3 class="text-2xl font-bold text-neutral-900 dark:text-white">{{ $member->name }}</h3>
            <p class="mt-1 text-base font-medium text-primary-600 dark:text-primary-300">{{ $member->designation }}</p>
            <p class="mt-4 line-clamp-4 text-sm leading-7 text-neutral-600 dark:text-neutral-400">{{ $member->short_bio }}</p>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                <x-team.social-icons :links="$member->social_links ?? []" />
                <a
                    href="{{ route('team.show', $member->slug) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-primary-500 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-300 hover:bg-primary-600"
                >
                    View Profile
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</article>
