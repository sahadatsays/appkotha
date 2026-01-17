{{-- Case Studies Section --}}
@props(['caseStudies'])

<section class="py-20 lg:py-28 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 mb-4">
                    Featured Case Studies
                </h2>
                <p class="text-lg text-neutral-600 max-w-2xl">
                    Real projects, real results. See how we've helped businesses like yours achieve their goals.
                </p>
            </div>
            <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-700 shrink-0">
                View All Projects
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Case Studies Grid --}}
        <div class="grid md:grid-cols-2 gap-8">
            @forelse($caseStudies as $study)
                <a href="{{ route('portfolio.show', $study) }}" class="group bg-white rounded-2xl overflow-hidden shadow-soft hover:shadow-elevated transition-shadow">
                    {{-- Image Placeholder --}}
                    <div class="aspect-video bg-neutral-200 flex items-center justify-center">
                        @if($study->featured_image)
                            <img src="{{ asset('storage/' . $study->featured_image) }}" alt="{{ $study->title }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-neutral-400">Project Image</span>
                        @endif
                    </div>

                    <div class="p-6 lg:p-8">
                        {{-- Client & Industry --}}
                        <div class="flex items-center gap-2 mb-4">
                            @if($study->client_industry)
                                <span class="px-3 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-full">
                                    {{ $study->client_industry }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-neutral-900 mb-3 group-hover:text-primary-600 transition-colors">
                            {{ $study->title }}
                        </h3>
                        <p class="text-neutral-600 mb-4">
                            {{ Str::limit($study->description, 120) }}
                        </p>

                        {{-- Metrics --}}
                        @if($study->metrics && count($study->metrics) > 0)
                            <div class="flex gap-6 pt-4 border-t border-neutral-100">
                                @foreach(array_slice($study->metrics, 0, 3) as $metric)
                                    <div>
                                        <p class="text-lg font-bold text-primary-600">{{ $metric['value'] ?? '' }}</p>
                                        <p class="text-xs text-neutral-500">{{ $metric['label'] ?? '' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                {{-- Placeholder Case Studies --}}
                @for($i = 0; $i < 2; $i++)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-soft">
                        <div class="aspect-video bg-neutral-200 flex items-center justify-center">
                            <span class="text-neutral-400">Project Image</span>
                        </div>
                        <div class="p-6 lg:p-8">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="px-3 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-full">
                                    {{ ['E-Commerce', 'FinTech'][$i] }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 mb-3">
                                {{ ['Multi-vendor Marketplace Platform', 'Mobile Banking Application'][$i] }}
                            </h3>
                            <p class="text-neutral-600 mb-4">
                                {{ ['A complete e-commerce solution handling 10,000+ daily transactions across 50+ vendors.', 'Secure banking app serving 100,000+ users with biometric authentication.'][$i] }}
                            </p>
                            <div class="flex gap-6 pt-4 border-t border-neutral-100">
                                <div>
                                    <p class="text-lg font-bold text-primary-600">{{ ['300%', '100K+'][$i] }}</p>
                                    <p class="text-xs text-neutral-500">{{ ['Revenue Growth', 'Active Users'][$i] }}</p>
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-primary-600">{{ ['50+', '99.9%'][$i] }}</p>
                                    <p class="text-xs text-neutral-500">{{ ['Vendors', 'Uptime'][$i] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>
