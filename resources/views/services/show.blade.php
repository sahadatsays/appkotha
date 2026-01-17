<x-layouts.frontend :title="$service->name">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    All Services
                </a>
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
                    {{ $service->name }}
                </h1>
                <p class="text-xl text-neutral-600 mb-8">
                    {{ $service->short_description }}
                </p>

                @if($service->starting_price)
                    <p class="text-lg mb-8">
                        Starting from <span class="text-3xl font-bold text-neutral-900">${{ number_format($service->starting_price, 0) }}</span>
                    </p>
                @endif

                <a href="{{ route('contact.quote') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                    Get a Quote
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Description --}}
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($service->description)) !!}
            </div>
        </div>
    </section>

    {{-- Process Steps --}}
    @if($service->process_steps && count($service->process_steps) > 0)
        <section class="py-20 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-neutral-900 mb-12 text-center">Our Process</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($service->process_steps as $index => $step)
                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <span class="text-white text-2xl font-bold">{{ $index + 1 }}</span>
                            </div>
                            <h3 class="font-bold text-neutral-900 mb-2">{{ $step['title'] ?? '' }}</h3>
                            <p class="text-sm text-neutral-600">{{ $step['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Other Services --}}
    @if($otherServices->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-8">Other Services</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($otherServices as $other)
                        <a href="{{ route('services.show', $other) }}" class="group bg-neutral-50 rounded-xl p-6 hover:bg-primary-50 transition-colors">
                            <h3 class="font-bold text-neutral-900 group-hover:text-primary-600 transition-colors">{{ $other->name }}</h3>
                            <p class="text-sm text-neutral-600 mt-2">{{ Str::limit($other->short_description, 60) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
