<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Appkotha') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Dark Mode Script (Prevent FOUC) -->
        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'system';
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (theme === 'dark' || (theme === 'system' && prefersDark)) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>
    </head>
    <body class="font-sans antialiased theme-bg theme-text-primary">
        <div class="min-h-screen grid lg:grid-cols-2">
            <div class="hidden lg:flex items-center justify-center px-10 bg-neutral-900 text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-20" style="background: linear-gradient(135deg, #00ff8f, #00a1ff);"></div>
                <div class="relative max-w-md">
                    <a href="{{ route('home') }}" class="inline-block mb-8">
                        <img src="{{ asset('assets/logos/log-dark.jpg') }}" alt="Appkotha" class="h-14 w-auto object-contain">
                    </a>
                    <h1 class="text-3xl font-bold">Your Appkotha customer workspace</h1>
                    <p class="mt-4 text-neutral-300">Track support, save insights, and access your upcoming customer tools in one premium portal.</p>
                </div>
            </div>

            <div class="flex items-center justify-center p-4 sm:p-8">
                <div class="w-full max-w-md saas-card p-6 sm:p-8 rounded-2xl">
                    <a href="{{ route('home') }}" class="inline-block lg:hidden mb-6">
                        <img src="{{ asset('assets/logos/logo-light.png') }}" alt="Appkotha" class="h-10 w-auto object-contain">
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
