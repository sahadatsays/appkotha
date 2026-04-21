<x-layouts.frontend title="Dashboard">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="space-y-6">
                    <div class="saas-card p-6">
                        <p class="text-sm theme-text-secondary">Welcome back</p>
                        <h1 class="text-3xl font-bold mt-2">{{ $user->name }}</h1>
                        <p class="theme-text-secondary mt-3">Manage support, track your activity, and explore upcoming Appkotha customer features.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 xl:grid-cols-5 gap-4">
                        <div class="saas-card p-4">
                            <p class="text-xs theme-text-secondary">Support Tickets</p>
                            <p class="text-2xl font-bold mt-2">{{ $stats['tickets_total'] }}</p>
                        </div>
                        <div class="saas-card p-4">
                            <p class="text-xs theme-text-secondary">Open Tickets</p>
                            <p class="text-2xl font-bold mt-2">{{ $stats['tickets_open'] }}</p>
                        </div>
                        <div class="saas-card p-4">
                            <p class="text-xs theme-text-secondary">Liked Blogs</p>
                            <p class="text-2xl font-bold mt-2">{{ $stats['liked_blogs'] }}</p>
                        </div>
                        <div class="saas-card p-4">
                            <p class="text-xs theme-text-secondary">Saved Items</p>
                            <p class="text-2xl font-bold mt-2">{{ $stats['saved_items'] }}</p>
                        </div>
                        <div class="saas-card p-4">
                            <p class="text-xs theme-text-secondary">Upcoming Features</p>
                            <p class="text-2xl font-bold mt-2">{{ $stats['upcoming_features'] }}</p>
                        </div>
                    </div>

                    <div class="grid xl:grid-cols-2 gap-6">
                        <div class="saas-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold">Recent support activity</h2>
                                <a href="{{ route('tickets.create') }}" class="saas-btn-primary px-3 py-1.5 text-sm font-semibold">Create Ticket</a>
                            </div>
                            @if($latestTickets->isEmpty())
                                <p class="theme-text-secondary text-sm">No support tickets yet. Create your first ticket if you need help.</p>
                            @else
                                <ul class="space-y-3">
                                    @foreach($latestTickets as $ticket)
                                        <li class="flex items-center justify-between">
                                            <a href="{{ route('tickets.show', $ticket) }}" class="text-sm theme-text-primary hover:underline">{{ $ticket->subject }}</a>
                                            <span class="text-xs theme-text-secondary">{{ $ticket->status->label() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="saas-card p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold">Recently liked blogs</h2>
                                <a href="{{ route('user.likes.index') }}" class="text-sm theme-text-secondary hover:theme-text-primary">View all</a>
                            </div>
                            @if($likedBlogs->isEmpty())
                                <p class="theme-text-secondary text-sm">No liked posts yet. Browse the blog and save useful content.</p>
                            @else
                                <ul class="space-y-3">
                                    @foreach($likedBlogs as $post)
                                        <li class="flex items-center justify-between gap-4">
                                            <a href="{{ route('blog.show', $post) }}" class="text-sm theme-text-primary hover:underline">{{ $post->title }}</a>
                                            <span class="text-xs theme-text-secondary">{{ $post->reading_time }} min</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="grid xl:grid-cols-3 gap-6">
                        <div class="saas-card p-6 xl:col-span-1">
                            <h3 class="font-semibold">Profile completion</h3>
                            <p class="text-3xl font-bold mt-3">{{ $profileCompletion }}%</p>
                            <div class="h-2 rounded-full bg-neutral-200 dark:bg-neutral-700 mt-3">
                                <div class="h-2 rounded-full bg-primary-500" style="width: {{ $profileCompletion }}%"></div>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="inline-block mt-4 text-sm theme-text-secondary hover:theme-text-primary">Complete profile</a>
                        </div>
                        <div class="saas-card p-6 xl:col-span-2">
                            <h3 class="font-semibold">Announcements</h3>
                            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                                <div class="rounded-xl border theme-border p-4">
                                    <p class="text-sm font-semibold theme-text-primary">Customer portal launched</p>
                                    <p class="text-sm theme-text-secondary mt-1">You can now track support and interact with blog content.</p>
                                </div>
                                <div class="rounded-xl border theme-border p-4">
                                    <p class="text-sm font-semibold theme-text-primary">More features coming soon</p>
                                    <p class="text-sm theme-text-secondary mt-1">Orders, notifications, and downloads will arrive in upcoming updates.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
