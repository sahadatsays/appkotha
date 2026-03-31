@props(['member'])

<article class="group rounded-2xl border border-neutral-100 bg-white p-6 shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-neutral-800 dark:bg-neutral-900">
    <div class="mb-5 overflow-hidden rounded-2xl bg-neutral-100 dark:bg-neutral-800">
        <img
            src="{{ $member->profile_image }}"
            alt="{{ $member->name }}"
            loading="lazy"
            class="h-60 w-full object-cover transition-transform duration-500 group-hover:scale-105"
        >
    </div>

    <h3 class="text-xl font-bold text-neutral-900 dark:text-white">{{ $member->name }}</h3>
    <p class="mt-1 text-sm font-medium text-primary-600 dark:text-primary-300">{{ $member->designation }}</p>
    <p class="mt-3 line-clamp-2 text-sm leading-6 text-neutral-600 dark:text-neutral-400">{{ $member->short_bio }}</p>

    <div class="mt-5 flex items-center justify-between gap-3">
        <x-team.social-icons :links="$member->social_links ?? []" icon-class="w-4 h-4" wrapper-class="flex items-center gap-1" />

        <a
            href="{{ route('team.show', $member->slug) }}"
            class="inline-flex items-center gap-2 rounded-xl bg-neutral-100 px-4 py-2 text-sm font-semibold text-neutral-800 transition-all duration-300 hover:bg-primary-500 hover:text-white dark:bg-neutral-800 dark:text-neutral-100 dark:hover:bg-primary-500"
        >
            View Profile
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</article>
