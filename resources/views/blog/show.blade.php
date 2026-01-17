<x-layouts.frontend :title="$post->title">
    <article>
        {{-- Hero Section --}}
        <header class="py-16 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Back to Blog
                </a>

                @if($post->category)
                    <a href="{{ route('blog.category', $post->category) }}" class="inline-block px-3 py-1 bg-primary-100 text-primary-600 text-sm font-medium rounded-full mb-4 hover:bg-primary-200 transition-colors">
                        {{ $post->category->name }}
                    </a>
                @endif

                <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-6 text-neutral-600">
                    @if($post->author)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-neutral-200 rounded-full flex items-center justify-center text-neutral-600 font-medium">
                                {{ strtoupper(substr($post->author->name, 0, 1)) }}
                            </div>
                            <span>{{ $post->author->name }}</span>
                        </div>
                    @endif
                    <span>{{ $post->formatted_date }}</span>
                    <span>{{ $post->reading_time }} min read</span>
                </div>
            </div>
        </header>

        {{-- Featured Image --}}
        @if($post->featured_image)
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full aspect-video object-cover rounded-2xl">
            </div>
        @endif

        {{-- Content --}}
        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="prose prose-lg max-w-none prose-headings:text-neutral-900 prose-p:text-neutral-600 prose-a:text-primary-600 prose-strong:text-neutral-900">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        {{-- Share & Tags --}}
        <div class="py-8 border-t border-neutral-100">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <p class="text-neutral-600">Share this article:</p>
                    <div class="flex gap-4">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center hover:bg-primary-100 hover:text-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center hover:bg-primary-100 hover:text-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- Related Posts --}}
    @if($relatedPosts->count() > 0)
        <section class="py-20 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-8">Related Articles</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $related)
                        <a href="{{ route('blog.show', $related) }}" class="group">
                            <div class="aspect-video bg-neutral-200 rounded-xl mb-4 overflow-hidden">
                                @if($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-neutral-400">Blog Image</span>
                                    </div>
                                @endif
                            </div>
                            <h3 class="font-bold text-neutral-900 group-hover:text-primary-600 transition-colors">
                                {{ $related->title }}
                            </h3>
                            <p class="text-sm text-neutral-500 mt-2">{{ $related->reading_time }} min read</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.frontend>
