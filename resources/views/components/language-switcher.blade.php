@props([
    'class' => '',
])

@php
    $currentLocale = app()->getLocale();
@endphp

<div {{ $attributes->merge(['class' => "inline-flex items-center gap-1 rounded-lg border border-neutral-200 bg-white p-1 dark:border-neutral-700 dark:bg-neutral-800 {$class}"]) }}>
    <span class="sr-only">{{ __('ui.language') }}</span>

    <form method="POST" action="{{ route('locale.update', 'en') }}">
        @csrf
        <button
            type="submit"
            class="rounded-md px-2 py-1 text-xs font-semibold transition-colors {{ $currentLocale === 'en' ? 'bg-primary-500 text-white' : 'text-neutral-600 hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}"
        >
            {{ __('ui.english') }}
        </button>
    </form>

    <form method="POST" action="{{ route('locale.update', 'bn') }}">
        @csrf
        <button
            type="submit"
            class="rounded-md px-2 py-1 text-xs font-semibold transition-colors {{ $currentLocale === 'bn' ? 'bg-primary-500 text-white' : 'text-neutral-600 hover:bg-neutral-100 dark:text-neutral-300 dark:hover:bg-neutral-700' }}"
        >
            {{ __('ui.bangla') }}
        </button>
    </form>
</div>
