<x-layouts.frontend title="Liked Blogs">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="saas-card p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Liked Blogs</h1>
                        <a href="{{ route('blog.index') }}" class="saas-btn-secondary px-3 py-2 text-sm font-semibold">Explore Blog</a>
                    </div>

                    @if($likedBlogs->isEmpty())
                        <div class="rounded-xl border theme-border p-8 text-center">
                            <p class="font-semibold">No liked blogs yet</p>
                            <p class="theme-text-secondary text-sm mt-2">Tap the like button on any blog post to build your reading list.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($likedBlogs as $post)
                                <article class="rounded-xl border theme-border p-4">
                                    <p class="text-xs theme-text-secondary">{{ $post->formatted_date }} • {{ $post->reading_time }} min read</p>
                                    <h2 class="text-lg font-semibold mt-2">{{ $post->title }}</h2>
                                    <p class="text-sm theme-text-secondary mt-2">{{ \Illuminate\Support\Str::limit($post->excerpt, 90) }}</p>
                                    <div class="mt-4 flex items-center justify-between">
                                        <a href="{{ route('blog.show', $post) }}" class="text-sm theme-text-secondary hover:theme-text-primary">Read post</a>
                                        <form method="POST" action="{{ route('blog.unlike', $post) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm theme-text-secondary hover:theme-text-primary">Unlike</button>
                                        </form>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $likedBlogs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
