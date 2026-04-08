@props([
    'class' => '',
])

@php
    $currentLocale = app()->getLocale();
    $localeLabel = $currentLocale === 'bn' ? __('ui.bangla') : __('ui.english');
@endphp

<div x-data="{ open: false }" {{ $attributes->merge(['class' => "relative inline-block {$class}"]) }}>
    <span class="sr-only">{{ __('ui.language') }}</span>

    <button
        type="button"
        @click="open = !open"
        class="inline-flex items-center gap-2 rounded-lg border border-neutral-200 bg-white px-3 py-2 text-xs font-semibold text-neutral-700 transition-colors hover:bg-neutral-100 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700"
        aria-label="{{ __('ui.language') }}"
    >
        <span>{{ $localeLabel }}</span>
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-show="open"
        x-transition
        @click.away="open = false"
        class="absolute right-0 z-50 mt-2 w-32 rounded-lg border border-neutral-200 bg-white p-1 shadow-lg dark:border-neutral-700 dark:bg-neutral-800"
    >
        <form method="POST" action="{{ route('locale.update', 'en') }}">
            @csrf
            <button
                type="submit"
                class="w-full rounded-md px-3 py-2 text-left text-xs font-medium transition-colors {{ $currentLocale === 'en' ? 'bg-primary-500 text-white' : 'text-neutral-700 hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
            >
                {{ __('ui.english') }}
            </button>
        </form>

        <form method="POST" action="{{ route('locale.update', 'bn') }}">
            @csrf
            <button
                type="submit"
                class="mt-1 w-full rounded-md px-3 py-2 text-left text-xs font-medium transition-colors {{ $currentLocale === 'bn' ? 'bg-primary-500 text-white' : 'text-neutral-700 hover:bg-neutral-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
            >
                {{ __('ui.bangla') }}
            </button>
        </form>
    </div>
</div>
