<x-layouts.frontend title="Future Features">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="saas-card p-6">
                    <h1 class="text-2xl font-bold">Future Features</h1>
                    <p class="theme-text-secondary mt-2">Planned modules for your customer workspace. These cards are ready for rollout.</p>

                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-6">
                        @foreach($featurePlaceholders as $feature)
                            <article class="rounded-xl border theme-border p-4">
                                <div class="flex items-center justify-between">
                                    <h2 class="font-semibold">{{ $feature['title'] }}</h2>
                                    <span class="text-xs px-2 py-1 rounded-full bg-neutral-100 dark:bg-neutral-800 theme-text-secondary">Coming Soon</span>
                                </div>
                                <p class="text-sm theme-text-secondary mt-3">{{ $feature['description'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
