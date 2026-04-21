<aside class="saas-card p-4">
    <p class="text-xs uppercase tracking-wider theme-text-secondary mb-4">Workspace</p>
    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-primary-500 text-white' : 'theme-text-secondary hover:theme-text-primary hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
            Dashboard
        </a>
        <a href="{{ route('tickets.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tickets.*') ? 'bg-primary-500 text-white' : 'theme-text-secondary hover:theme-text-primary hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
            Support Tickets
        </a>
        <a href="{{ route('user.likes.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('user.likes.*') ? 'bg-primary-500 text-white' : 'theme-text-secondary hover:theme-text-primary hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
            Liked Blogs
        </a>
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('profile.*') ? 'bg-primary-500 text-white' : 'theme-text-secondary hover:theme-text-primary hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
            Profile & Settings
        </a>
        <a href="{{ route('user.features') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('user.features') ? 'bg-primary-500 text-white' : 'theme-text-secondary hover:theme-text-primary hover:bg-neutral-100 dark:hover:bg-neutral-800' }}">
            Future Features
        </a>
    </nav>
</aside>
