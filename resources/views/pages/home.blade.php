<x-layouts.frontend title="Premium Software Solutions">
    {{-- Hero Section --}}
    @include('components.frontend.home.hero')

    {{-- Trust Signals --}}
    @include('components.frontend.home.trust-signals')

    {{-- Problem / Solution --}}
    @include('components.frontend.home.problem-solution')

    {{-- Dual Offering (Products & Services) --}}
    @include('components.frontend.home.dual-offering', ['products' => $products, 'services' => $services])

    {{-- Our Process --}}
    @include('components.frontend.home.process')

    {{-- Testimonials --}}
    @include('components.frontend.home.testimonials', ['testimonials' => $testimonials])

    {{-- Case Studies --}}
    @include('components.frontend.home.case-studies', ['caseStudies' => $caseStudies])

    {{-- FAQ --}}
    @include('components.frontend.home.faq')

    {{-- Final CTA --}}
    @include('components.frontend.home.cta')
</x-layouts.frontend>
