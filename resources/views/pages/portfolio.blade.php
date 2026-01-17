<x-layouts.frontend title="Portfolio">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
                    Our Work
                </h1>
                <p class="text-xl text-neutral-600">
                    Explore our portfolio of successful projects and see how we've helped businesses achieve their goals.
                </p>
            </div>
        </div>
    </section>

    {{-- Case Studies Grid --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($caseStudies->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($caseStudies as $study)
                        <a href="{{ route('portfolio.show', $study) }}" class="group bg-white rounded-2xl overflow-hidden shadow-soft hover:shadow-elevated transition-shadow border border-neutral-100">
                            <div class="aspect-video bg-neutral-200 flex items-center justify-center">
                                @if($study->featured_image)
                                    <img src="{{ asset('storage/' . $study->featured_image) }}" alt="{{ $study->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-neutral-400">Project Image</span>
                                @endif
                            </div>
                            <div class="p-6">
                                @if($study->client_industry)
                                    <span class="px-3 py-1 bg-primary-50 text-primary-600 text-xs font-medium rounded-full">
                                        {{ $study->client_industry }}
                                    </span>
                                @endif
                                <h3 class="text-xl font-bold text-neutral-900 mt-4 mb-3 group-hover:text-primary-600 transition-colors">
                                    {{ $study->title }}
                                </h3>
                                <p class="text-neutral-600 text-sm">
                                    {{ Str::limit($study->description, 100) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $caseStudies->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-neutral-500 text-lg">Portfolio items coming soon. Contact us to learn about our past projects.</p>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                        Contact Us
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
