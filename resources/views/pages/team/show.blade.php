<x-layouts.frontend>
    <section class="relative">
        <div class="h-64 w-full sm:h-80 lg:h-96">
            @if($member->cover_image)
                <img src="{{ $member->cover_image }}" alt="{{ $member->name }} cover" class="h-full w-full object-cover" loading="lazy">
            @else
                <div class="h-full w-full bg-gradient-to-r from-primary-500 to-primary-700"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        </div>
    </section>

    <section class="relative -mt-20 pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl dark:bg-neutral-900">
                <div class="grid gap-10 p-6 lg:grid-cols-[340px_minmax(0,1fr)] lg:p-10">
                    <aside>
                        <div class="overflow-hidden rounded-2xl bg-neutral-100 dark:bg-neutral-800">
                            <img src="{{ $member->profile_image }}" alt="{{ $member->name }}" class="h-80 w-full object-cover" loading="lazy">
                        </div>

                        <div class="mt-6 space-y-3 text-sm text-neutral-600 dark:text-neutral-300">
                            @if($member->location)
                                <p><span class="font-semibold text-neutral-900 dark:text-white">Location:</span> {{ $member->location }}</p>
                            @endif
                            @if($member->experience_years)
                                <p><span class="font-semibold text-neutral-900 dark:text-white">Experience:</span> {{ $member->experience_years }} years</p>
                            @endif
                            @if($member->email)
                                <p><span class="font-semibold text-neutral-900 dark:text-white">Email:</span> <a href="mailto:{{ $member->email }}" class="text-primary-600 hover:underline dark:text-primary-300">{{ $member->email }}</a></p>
                            @endif
                            @if($member->phone)
                                <p><span class="font-semibold text-neutral-900 dark:text-white">Phone:</span> <a href="tel:{{ $member->phone }}" class="text-primary-600 hover:underline dark:text-primary-300">{{ $member->phone }}</a></p>
                            @endif
                        </div>

                        <div class="mt-5 border-t border-neutral-200 pt-5 dark:border-neutral-800">
                            <x-team.social-icons :links="$member->social_links ?? []" />
                        </div>
                    </aside>

                    <div>
                        <h1 class="text-3xl font-bold text-neutral-900 sm:text-4xl dark:text-white">{{ $member->name }}</h1>
                        <p class="mt-2 text-lg font-medium text-primary-600 dark:text-primary-300">{{ $member->designation }}</p>

                        <div class="mt-8">
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white">About {{ $member->name }}</h2>
                            <div class="prose prose-neutral mt-4 max-w-none dark:prose-invert">
                                {!! nl2br(e($member->full_bio)) !!}
                            </div>
                        </div>

                        @if(!empty($member->skills))
                            <div class="mt-8">
                                <h2 class="text-xl font-bold text-neutral-900 dark:text-white">Skills</h2>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach($member->skills as $skill)
                                        <span class="rounded-full bg-primary-50 px-3 py-1 text-sm font-semibold text-primary-700 dark:bg-primary-900/30 dark:text-primary-300">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-10 rounded-2xl bg-neutral-50 p-6 dark:bg-neutral-800/70">
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Want to work with {{ $member->name }} and our team?</h3>
                            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Tell us about your project and we will connect you with the right experts.</p>
                            <a href="{{ route('contact.index') }}" class="mt-4 inline-flex items-center gap-2 rounded-xl bg-primary-500 px-5 py-2.5 text-sm font-semibold text-white transition-all duration-300 hover:bg-primary-600">
                                Contact Us
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($relatedMembers->isNotEmpty())
                <div class="mt-14">
                    <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">More Team Members</h2>
                    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($relatedMembers as $relatedMember)
                            <x-team.card :member="$relatedMember" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layouts.frontend>
