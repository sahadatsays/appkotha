<header class="fixed top-0 left-0 right-0 bg-white/95 dark:bg-neutral-900/95 backdrop-blur-sm border-b border-neutral-100 dark:border-neutral-800 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0 group">
                <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <span class="text-white font-bold text-lg">a</span>
                </div>
                <span class="text-xl font-bold text-neutral-900 dark:text-white transition-colors">app<span class="text-primary-500">Kotha</span></span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-primary-500' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-500' }} transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-primary-500 hover:after:w-full after:transition-all after:duration-300">
                    Home
                </a>

                <!-- Products Dropdown -->
                <div class="relative group">
                    <a href="{{ route('products.index') }}" class="text-sm font-medium {{ request()->routeIs('products.*') ? 'text-primary-500' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-500' }} transition-all duration-300 flex items-center gap-1">
                        Products
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-elevated border border-neutral-100 dark:border-neutral-700 py-2 min-w-48">
                            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 transition-colors hover:translate-x-1 transform duration-200">
                                All Products
                            </a>
                            @php
                                $headerProducts = \App\Models\Product::published()->featured()->take(3)->get();
                            @endphp
                            @foreach($headerProducts as $product)
                                <a href="{{ route('products.show', $product) }}" class="block px-4 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 transition-colors hover:translate-x-1 transform duration-200">
                                    {{ $product->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Services Dropdown -->
                <div class="relative group">
                    <a href="{{ route('services.index') }}" class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-primary-500' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-500' }} transition-all duration-300 flex items-center gap-1">
                        Services
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-elevated border border-neutral-100 dark:border-neutral-700 py-2 min-w-48">
                            <a href="{{ route('services.index') }}" class="block px-4 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 transition-colors hover:translate-x-1 transform duration-200">
                                All Services
                            </a>
                            @php
                                $headerServices = \App\Models\Service::published()->featured()->take(4)->get();
                            @endphp
                            @foreach($headerServices as $service)
                                <a href="{{ route('services.show', $service) }}" class="block px-4 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 transition-colors hover:translate-x-1 transform duration-200">
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('portfolio') }}" class="text-sm font-medium {{ request()->routeIs('portfolio*') ? 'text-primary-500' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-500' }} transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-primary-500 hover:after:w-full after:transition-all after:duration-300">
                    Portfolio
                </a>

                <a href="{{ route('about') }}" class="text-sm font-medium {{ request()->routeIs('about') ? 'text-primary-500' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-500' }} transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-primary-500 hover:after:w-full after:transition-all after:duration-300">
                    About
                </a>

                <a href="{{ route('blog.index') }}" class="text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-primary-500' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-500' }} transition-all duration-300 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-primary-500 hover:after:w-full after:transition-all after:duration-300">
                    Blog
                </a>
            </div>

            <!-- Desktop CTA Buttons -->
            <div class="hidden lg:flex items-center gap-4">
                <!-- Theme Toggle -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 rounded-lg text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="Toggle theme">
                        <!-- Sun icon (shown when light mode selected) -->
                        <svg x-show="theme === 'light'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <!-- Moon icon (shown when dark mode selected) -->
                        <svg x-show="theme === 'dark'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- System/Computer icon (shown when system mode selected) -->
                        <svg x-show="theme === 'system'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-36 bg-white dark:bg-neutral-800 rounded-xl shadow-elevated border border-neutral-100 dark:border-neutral-700 py-1 z-50">
                        <button @click="theme = 'light'; open = false" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700" :class="{ 'text-primary-500': theme === 'light' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Light
                        </button>
                        <button @click="theme = 'dark'; open = false" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700" :class="{ 'text-primary-500': theme === 'dark' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            Dark
                        </button>
                        <button @click="theme = 'system'; open = false" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700" :class="{ 'text-primary-500': theme === 'system' }">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            System
                        </button>
                    </div>
                </div>

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative p-2 rounded-lg text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="Shopping Cart">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @php
                        $cartCount = app(\App\Services\CartService::class)->getCount();
                    @endphp
                    <span id="cart-count" class="absolute -top-1 -right-1 w-5 h-5 bg-primary-500 text-white text-xs font-bold rounded-full flex items-center justify-center {{ $cartCount > 0 ? '' : 'hidden' }}">
                        {{ $cartCount }}
                    </span>
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-500 transition-all duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-500 transition-all duration-300">
                        Sign In
                    </a>
                @endauth
                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-white text-sm font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 shadow-sm hover:shadow-md hover:scale-105 btn-shine">
                    Get Started
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center gap-2 lg:hidden">
                <!-- Mobile Theme Toggle -->
                <button @click="theme = theme === 'light' ? 'dark' : (theme === 'dark' ? 'system' : 'light')" class="p-2 rounded-lg text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="Toggle theme">
                    <!-- Sun icon (shown when light mode selected) -->
                    <svg x-show="theme === 'light'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon icon (shown when dark mode selected) -->
                    <svg x-show="theme === 'dark'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <!-- System/Computer icon (shown when system mode selected) -->
                    <svg x-show="theme === 'system'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </button>
                <button id="mobile-menu-btn" class="p-2 -mr-2 text-neutral-600 dark:text-neutral-300 hover:text-neutral-900 dark:hover:text-white" aria-label="Open menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 right-0 bottom-0 w-80 max-w-full bg-white dark:bg-neutral-900 shadow-2xl z-50 transform translate-x-full transition-transform duration-300 lg:hidden overflow-y-auto">
        <div class="p-4 border-b border-neutral-100 dark:border-neutral-800 flex items-center justify-between">
            <span class="text-lg font-bold text-neutral-900 dark:text-white">Menu</span>
            <button id="mobile-menu-close" class="p-2 -mr-2 text-neutral-600 dark:text-neutral-300 hover:text-neutral-900 dark:hover:text-white" aria-label="Close menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('home') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                Home
            </a>
            <a href="{{ route('products.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('products.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                Products
            </a>
            <a href="{{ route('services.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('services.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                Services
            </a>
            <a href="{{ route('portfolio') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('portfolio*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                Portfolio
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('about') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                About
            </a>
            <a href="{{ route('blog.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('blog.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                Blog
            </a>
            <a href="{{ route('contact.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('contact.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                Contact
            </a>
            <a href="{{ route('cart.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('cart.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-50 dark:hover:bg-neutral-800' }}">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Cart
                </span>
                @if($cartCount > 0)
                    <span class="bg-primary-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
                @endif
            </a>
        </nav>
        <div class="p-4 border-t border-neutral-100 dark:border-neutral-800 space-y-3">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="block w-full text-center px-4 py-3 bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-medium rounded-xl hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 font-medium rounded-xl hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors">
                    Sign In
                </a>
            @endauth
            <a href="{{ route('contact.index') }}" class="block w-full text-center px-4 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                Get Started
            </a>
        </div>
    </div>
</header>

<!-- Spacer for fixed header -->
<div class="h-16 lg:h-20"></div>
