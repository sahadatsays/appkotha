@props([
    'id' => 'modal',
    'title' => '',
    'size' => 'md', // sm, md, lg, xl, full
])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        'full' => 'max-w-4xl',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<div
    data-modal="{{ $id }}"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-{{ $id }}-title"
>
    <div
        data-modal-content
        class="w-full {{ $sizeClass }} bg-white dark:bg-neutral-800 rounded-2xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300"
    >
        {{-- Header --}}
        @if($title)
        <div class="flex items-center justify-between px-6 py-4 border-b border-neutral-200 dark:border-neutral-700">
            <h3 id="modal-{{ $id }}-title" class="text-lg font-semibold text-neutral-900 dark:text-white">
                {{ $title }}
            </h3>
            <button
                type="button"
                data-modal-close
                class="p-2 text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-700 transition-colors"
                aria-label="Close modal"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif

        {{-- Body --}}
        <div class="px-6 py-4">
            {{ $slot }}
        </div>

        {{-- Footer (optional) --}}
        @isset($footer)
        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
            {{ $footer }}
        </div>
        @endisset
    </div>
</div>
