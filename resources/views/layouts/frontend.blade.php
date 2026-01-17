<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" x-data="{ theme: localStorage.getItem('theme') || 'system' }" x-init="
    $watch('theme', val => {
        localStorage.setItem('theme', val);
        updateTheme();
    });
    function updateTheme() {
        if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
    updateTheme();
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateTheme);
">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'appKotha') }} | Software Solutions from Bangladesh</title>
    <meta name="description" content="{{ $metaDescription ?? 'appKotha delivers premium digital products and custom software development services. Trusted by 500+ clients worldwide.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'software development, digital products, web development, mobile apps, Bangladesh' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Prevent flash of unstyled content -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Alpine.js cloak style -->
    <style>[x-cloak] { display: none !important; }</style>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-sans antialiased bg-white dark:bg-neutral-900 text-neutral-800 dark:text-neutral-100 transition-colors duration-200">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-primary-500 text-white px-4 py-2 rounded-lg z-50">
        Skip to main content
    </a>

    <!-- Header -->
    @include('components.frontend.header')

    <!-- Main Content -->
    <main id="main-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('components.frontend.footer')

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    @stack('scripts')

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const mobileMenuClose = document.getElementById('mobile-menu-close');

            function openMobileMenu() {
                mobileMenu?.classList.remove('translate-x-full');
                mobileMenuOverlay?.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileMenu() {
                mobileMenu?.classList.add('translate-x-full');
                mobileMenuOverlay?.classList.add('hidden');
                document.body.style.overflow = '';
            }

            mobileMenuBtn?.addEventListener('click', openMobileMenu);
            mobileMenuClose?.addEventListener('click', closeMobileMenu);
            mobileMenuOverlay?.addEventListener('click', closeMobileMenu);
        });
    </script>
</body>
</html>
