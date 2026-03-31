<x-layouts.frontend>
    <section class="bg-gradient-to-br from-neutral-50 via-white to-primary-50 py-16 sm:py-20 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <span class="inline-flex rounded-full bg-primary-100 px-4 py-1 text-sm font-semibold text-primary-700 dark:bg-primary-900/30 dark:text-primary-300">
                    Our People
                </span>
                <h1 class="mt-5 text-3xl font-bold text-neutral-900 sm:text-4xl lg:text-5xl dark:text-white">Meet Our Team</h1>
                <p class="mt-4 text-base leading-7 text-neutral-600 sm:text-lg dark:text-neutral-400">
                    We are a collaborative team of engineers, designers, and product thinkers committed to building reliable software and delivering measurable business outcomes.
                </p>
            </div>
        </div>
    </section>

    <section class="py-14 sm:py-16 lg:py-20" x-data="{ tab: 'all' }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($featuredMembers->isNotEmpty())
                <div class="mb-10 flex flex-wrap items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">Featured Members</h2>
                    <div class="inline-flex rounded-xl bg-neutral-100 p-1 dark:bg-neutral-800">
                        <button @click="tab = 'all'" :class="tab === 'all' ? 'bg-white dark:bg-neutral-700 shadow-sm text-neutral-900 dark:text-white' : 'text-neutral-500 dark:text-neutral-400'" class="rounded-lg px-3 py-1.5 text-sm font-semibold transition-all duration-300">All</button>
                        <button @click="tab = 'featured'" :class="tab === 'featured' ? 'bg-white dark:bg-neutral-700 shadow-sm text-neutral-900 dark:text-white' : 'text-neutral-500 dark:text-neutral-400'" class="rounded-lg px-3 py-1.5 text-sm font-semibold transition-all duration-300">Featured</button>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-2" x-show="tab !== 'featured'" x-transition>
                    @foreach($featuredMembers as $member)
                        <x-team.featured-card :member="$member" />
                    @endforeach
                </div>
            @endif

            <div class="mt-12">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-white">All Team Members</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-4" x-show="tab !== 'featured'" x-transition>
                    @foreach($teamMembers as $member)
                        <x-team.card :member="$member" />
                    @endforeach
                </div>
                @if($featuredMembers->isNotEmpty())
                    <div class="mt-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-4" x-show="tab === 'featured'" x-transition>
                        @foreach($featuredMembers as $member)
                            <x-team.card :member="$member" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layouts.frontend>
