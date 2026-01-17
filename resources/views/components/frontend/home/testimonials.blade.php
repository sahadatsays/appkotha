{{-- Testimonials Section --}}
@props(['testimonials'])

<section class="py-20 lg:py-28 bg-neutral-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                What Our Clients Say
            </h2>
            <p class="text-lg text-neutral-400">
                Don't just take our word for it. Hear from businesses we've helped succeed.
            </p>
        </div>

        {{-- Testimonials Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
                <div class="bg-neutral-800 rounded-2xl p-8 relative hover-lift" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                    {{-- Quote Icon --}}
                    <div class="absolute top-6 right-6 text-neutral-700">
                        <svg class="w-10 h-10 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    {{-- Rating --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <p class="text-neutral-300 leading-relaxed mb-6">
                        "{{ $testimonial->quote }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-neutral-700 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-white">{{ $testimonial->client_name }}</p>
                            <p class="text-sm text-neutral-400">
                                {{ $testimonial->client_title }}
                                @if($testimonial->client_company)
                                    at {{ $testimonial->client_company }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Placeholder Testimonials --}}
                @for($i = 0; $i < 3; $i++)
                    <div class="bg-neutral-800 rounded-2xl p-8 relative hover-lift" data-aos="fade-up" data-aos-delay="{{ ($i + 1) * 100 }}">
                        <div class="absolute top-6 right-6 text-neutral-700">
                            <svg class="w-10 h-10 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <div class="flex gap-1 mb-4">
                            @for($j = 0; $j < 5; $j++)
                                <svg class="w-5 h-5 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>

                        <p class="text-neutral-300 leading-relaxed mb-6">
                            "appKotha delivered exactly what we needed. Their team understood our requirements perfectly and delivered ahead of schedule. Highly recommended!"
                        </p>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-neutral-700 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ ['J', 'S', 'M'][$i] }}
                            </div>
                            <div>
                                <p class="font-semibold text-white">{{ ['John Smith', 'Sarah Johnson', 'Michael Chen'][$i] }}</p>
                                <p class="text-sm text-neutral-400">{{ ['CEO at TechStart', 'CTO at DataFlow', 'Founder at AppScale'][$i] }}</p>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>
