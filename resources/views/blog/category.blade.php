<x-layouts.frontend :title="$category->name . ' - Blog'">
    {{-- Hero Section --}}
    <section class="py-16 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                All Posts
            </a>
            <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-4">
                {{ $category->name }}
            </h1>
            @if($category->description)
                <p class="text-xl text-neutral-600">{{ $category->description }}</p>
            @endif
        </div>
    </section>

    {{-- Posts Grid --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($posts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <a href="{{ route('blog.show', $post) }}" class="group">
                            <div class="aspect-video bg-neutral-100 rounded-xl mb-4 overflow-hidden">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-neutral-400">Blog Image</span>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-neutral-900 mb-2 group-hover:text-primary-600 transition-colors">
                                {{ $post->title }}
                            </h3>
                            <p class="text-sm text-neutral-600 mb-3">
                                {{ Str::limit($post->excerpt, 100) }}
                            </p>
                            <div class="flex items-center gap-4 text-xs text-neutral-500">
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
                <div class="text-center py-20">
                    <p class="text-neutral-600">No posts in this category yet.</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.frontend>
