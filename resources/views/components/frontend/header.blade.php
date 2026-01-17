<header class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm border-b border-neutral-100 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-lg">a</span>
                </div>
                <span class="text-xl font-bold text-neutral-900">app<span class="text-primary-500">Kotha</span></span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-primary-500' : 'text-neutral-600 hover:text-primary-500' }} transition-colors">
                    Home
                </a>

                <!-- Products Dropdown -->
                <div class="relative group">
                    <a href="{{ route('products.index') }}" class="text-sm font-medium {{ request()->routeIs('products.*') ? 'text-primary-500' : 'text-neutral-600 hover:text-primary-500' }} transition-colors flex items-center gap-1">
                        Products
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="bg-white rounded-xl shadow-elevated border border-neutral-100 py-2 min-w-48">
                            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm text-neutral-600 hover:bg-primary-50 hover:text-primary-600">
                                All Products
                            </a>
                            @php
                                $headerProducts = \App\Models\Product::published()->featured()->take(3)->get();
                            @endphp
                            @foreach($headerProducts as $product)
                                <a href="{{ route('products.show', $product) }}" class="block px-4 py-2 text-sm text-neutral-600 hover:bg-primary-50 hover:text-primary-600">
                                    {{ $product->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Services Dropdown -->
                <div class="relative group">
                    <a href="{{ route('services.index') }}" class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-primary-500' : 'text-neutral-600 hover:text-primary-500' }} transition-colors flex items-center gap-1">
                        Services
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div class="absolute top-full left-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="bg-white rounded-xl shadow-elevated border border-neutral-100 py-2 min-w-48">
                            <a href="{{ route('services.index') }}" class="block px-4 py-2 text-sm text-neutral-600 hover:bg-primary-50 hover:text-primary-600">
                                All Services
                            </a>
                            @php
                                $headerServices = \App\Models\Service::published()->featured()->take(4)->get();
                            @endphp
                            @foreach($headerServices as $service)
                                <a href="{{ route('services.show', $service) }}" class="block px-4 py-2 text-sm text-neutral-600 hover:bg-primary-50 hover:text-primary-600">
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('portfolio') }}" class="text-sm font-medium {{ request()->routeIs('portfolio*') ? 'text-primary-500' : 'text-neutral-600 hover:text-primary-500' }} transition-colors">
                    Portfolio
                </a>

                <a href="{{ route('about') }}" class="text-sm font-medium {{ request()->routeIs('about') ? 'text-primary-500' : 'text-neutral-600 hover:text-primary-500' }} transition-colors">
                    About
                </a>

                <a href="{{ route('blog.index') }}" class="text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-primary-500' : 'text-neutral-600 hover:text-primary-500' }} transition-colors">
                    Blog
                </a>
            </div>

            <!-- Desktop CTA Buttons -->
            <div class="hidden lg:flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-neutral-600 hover:text-primary-500 transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-neutral-600 hover:text-primary-500 transition-colors">
                        Sign In
                    </a>
                @endauth
                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-500 text-white text-sm font-semibold rounded-xl hover:bg-primary-600 transition-colors shadow-sm">
                    Get Started
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 -mr-2 text-neutral-600 hover:text-neutral-900" aria-label="Open menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 right-0 bottom-0 w-80 max-w-full bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 lg:hidden overflow-y-auto">
        <div class="p-4 border-b border-neutral-100 flex items-center justify-between">
            <span class="text-lg font-bold text-neutral-900">Menu</span>
            <button id="mobile-menu-close" class="p-2 -mr-2 text-neutral-600 hover:text-neutral-900" aria-label="Close menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                Home
            </a>
            <a href="{{ route('products.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('products.*') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                Products
            </a>
            <a href="{{ route('services.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('services.*') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                Services
            </a>
            <a href="{{ route('portfolio') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('portfolio*') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                Portfolio
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                About
            </a>
            <a href="{{ route('blog.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('blog.*') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                Blog
            </a>
            <a href="{{ route('contact.index') }}" class="block px-4 py-3 rounded-xl {{ request()->routeIs('contact.*') ? 'bg-primary-50 text-primary-600' : 'text-neutral-700 hover:bg-neutral-50' }}">
                Contact
            </a>
        </nav>
        <div class="p-4 border-t border-neutral-100 space-y-3">
            @auth
                <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-3 bg-neutral-100 text-neutral-700 font-medium rounded-xl hover:bg-neutral-200 transition-colors">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 bg-neutral-100 text-neutral-700 font-medium rounded-xl hover:bg-neutral-200 transition-colors">
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
