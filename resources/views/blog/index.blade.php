<x-layouts.frontend title="Blog">
    {{-- Hero Section --}}
    <section class="py-16 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 dark:text-white mb-6" data-aos="fade-up">
                    Blog & Insights
                </h1>
                <p class="text-xl text-neutral-600 dark:text-neutral-400" data-aos="fade-up" data-aos-delay="100">
                    Tips, tutorials, and insights on software development, technology trends, and business growth.
                </p>
            </div>
        </div>
    </section>

    {{-- Blog Grid --}}
    <section class="py-20 bg-white dark:bg-neutral-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-3">
                    @if($posts->count() > 0)
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($posts as $post)
                                <a href="{{ route('blog.show', $post) }}" class="group hover-lift" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                                    <div class="aspect-video bg-neutral-100 dark:bg-neutral-800 rounded-xl mb-4 overflow-hidden img-zoom">
                                        @if($post->featured_image)
                                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-neutral-400 dark:text-neutral-500">Blog Image</span>
                                            </div>
                                        @endif
                                    </div>
                                    @if($post->category)
                                        <span class="text-xs font-medium text-primary-600 dark:text-primary-400 uppercase tracking-wider">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    <h3 class="text-lg font-bold text-neutral-900 dark:text-white mt-2 mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">
                                        {{ Str::limit($post->excerpt, 100) }}
                                    </p>
                                    <div class="flex items-center gap-4 text-xs text-neutral-500 dark:text-neutral-400">
                                        <span>{{ $post->formatted_date }}</span>
                                        <span>•</span>
                                        <span>{{ $post->reading_time }} min read</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-20" data-aos="fade-up">
                            <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-primary-600 dark:text-primary-400 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">No Posts Yet</h3>
                            <p class="text-neutral-600 dark:text-neutral-400">Check back soon for articles and insights.</p>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1">
                    {{-- Categories --}}
                    @if($categories->count() > 0)
                        <div class="bg-neutral-50 dark:bg-neutral-800 rounded-xl p-6 mb-8" data-aos="fade-left" data-aos-delay="200">
                            <h3 class="font-bold text-neutral-900 dark:text-white mb-4">Categories</h3>
                            <ul class="space-y-3">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.category', $category) }}" class="flex items-center justify-between text-neutral-600 dark:text-neutral-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors hover:translate-x-1">
                                            <span>{{ $category->name }}</span>
                                            <span class="text-sm text-neutral-400 dark:text-neutral-500">({{ $category->posts_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Popular Posts --}}
                    @if($featuredPosts->count() > 0)
                        <div class="bg-neutral-50 dark:bg-neutral-800 rounded-xl p-6" data-aos="fade-left" data-aos-delay="300">
                            <h3 class="font-bold text-neutral-900 dark:text-white mb-4">Popular Posts</h3>
                            <ul class="space-y-4">
                                @foreach($featuredPosts as $popular)
                                    <li>
                                        <a href="{{ route('blog.show', $popular) }}" class="text-sm text-neutral-700 dark:text-neutral-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                            {{ $popular->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
