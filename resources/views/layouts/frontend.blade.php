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

    <!-- SEO Meta Tags -->
    @if(isset($seoMeta))
        <x-seo-meta
            :title="$seoMeta['title'] ?? null"
            :description="$seoMeta['description'] ?? null"
            :keywords="$seoMeta['keywords'] ?? null"
            :image="$seoMeta['image'] ?? null"
            :url="$seoMeta['url'] ?? null"
            :type="$seoMeta['type'] ?? 'website'"
            :publishedTime="$seoMeta['published_time'] ?? null"
            :modifiedTime="$seoMeta['modified_time'] ?? null"
            :author="$seoMeta['author'] ?? null"
            :price="$seoMeta['price'] ?? null"
        />
    @else
        <x-seo-meta />
    @endif

    <!-- Structured Data -->
    @if(isset($structuredDataType))
        <x-seo-structured-data :type="$structuredDataType" :data="$structuredData ?? null" />
    @else
        <x-seo-structured-data />
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    <!-- DNS Prefetch & Preconnect for Performance -->
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    <!-- Fonts - Inter (with display=swap for performance) -->
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet">

    <!-- AOS Animation Library (defer loading) -->
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"></noscript>

    <!-- jQuery (load synchronously for compatibility) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Alpine.js Collapse plugin (load before Alpine.js) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js (defer for performance) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Prevent flash of unstyled content -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Alpine.js cloak style & Custom Animations -->
    <style>
        [x-cloak] { display: none !important; }

        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes bounce-soft {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-pulse-soft { animation: pulse-soft 2s ease-in-out infinite; }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }
        .animate-bounce-soft { animation: bounce-soft 2s ease-in-out infinite; }

        /* Hover lift effect */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
        }

        /* Card hover scale */
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }

        /* Image zoom on hover */
        .img-zoom {
            overflow: hidden;
        }
        .img-zoom img {
            transition: transform 0.5s ease;
        }
        .img-zoom:hover img {
            transform: scale(1.1);
        }

        /* Underline animation for links */
        .link-underline {
            position: relative;
        }
        .link-underline::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: currentColor;
            transition: width 0.3s ease;
        }
        .link-underline:hover::after {
            width: 100%;
        }

        /* Button shine effect */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        .btn-shine:hover::before {
            left: 100%;
        }

        /* Stagger animation delays */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }
        .stagger-6 { animation-delay: 0.6s; }
    </style>

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
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300"></div>

    <!-- Scroll to Top Button -->
    <button id="scroll-top-btn" class="fixed bottom-6 right-6 w-12 h-12 bg-primary-500 hover:bg-primary-600 text-white rounded-full shadow-lg flex items-center justify-center z-40 opacity-0 invisible transition-all duration-300 hover:scale-110" aria-label="Scroll to top">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Generic Modal Template (can be triggered with data-modal-open="example") -->
    @stack('modals')

    @stack('scripts')

    <!-- AOS Animation Library (load after page) -->
    <script>
        // Load AOS after page load for better performance
        window.addEventListener('load', function() {
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/aos@2.3.1/dist/aos.js';
            script.onload = function() {
                if (typeof AOS !== 'undefined') {
                    AOS.init({
                        duration: 800,
                        easing: 'ease-out-cubic',
                        once: true,
                        offset: 50,
                        disable: window.innerWidth < 768 ? 'mobile' : false
                    });
                }
            };
            document.body.appendChild(script);
        });
    </script>
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

            // Counter animation for stats
            const counters = document.querySelectorAll('[data-counter]');
            const observerOptions = { threshold: 0.5 };

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseInt(counter.getAttribute('data-counter'));
                        const suffix = counter.getAttribute('data-suffix') || '';
                        const duration = 2000;
                        const step = target / (duration / 16);
                        let current = 0;

                        const updateCounter = () => {
                            current += step;
                            if (current < target) {
                                counter.textContent = Math.floor(current) + suffix;
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.textContent = target + suffix;
                            }
                        };

                        updateCounter();
                        counterObserver.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => counterObserver.observe(counter));
        });
    </script>

    <!-- jQuery Interactions -->
    <script>
    (function($) {
        'use strict';

        // Mobile Menu
        const MobileMenu = {
            init() {
                this.$btn = $('#mobile-menu-btn');
                this.$menu = $('#mobile-menu');
                this.$overlay = $('#mobile-menu-overlay');
                this.$close = $('#mobile-menu-close');
                if (!this.$menu.length) return;
                this.bindEvents();
            },
            bindEvents() {
                this.$btn.on('click', () => this.open());
                this.$close.on('click', () => this.close());
                this.$overlay.on('click', () => this.close());
                $(document).on('keydown', (e) => { if (e.key === 'Escape') this.close(); });
                this.$menu.find('a').on('click', () => this.close());
            },
            open() {
                this.$menu.removeClass('translate-x-full');
                this.$overlay.removeClass('hidden');
                $('body').addClass('overflow-hidden');
            },
            close() {
                this.$menu.addClass('translate-x-full');
                this.$overlay.addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }
        };

        // Modal Dialogs
        const Modal = {
            init() {
                $('[data-modal-open]').on('click', function(e) {
                    e.preventDefault();
                    Modal.open($(this).data('modal-open'));
                });
                $(document).on('click', '[data-modal-close]', function() {
                    Modal.close($(this).closest('[data-modal]'));
                });
                $(document).on('click', '[data-modal]', function(e) {
                    if (e.target === this) Modal.close($(this));
                });
                $(document).on('keydown', (e) => {
                    if (e.key === 'Escape') $('[data-modal]:visible').each(function() { Modal.close($(this)); });
                });
            },
            open(id) {
                const $modal = $(`[data-modal="${id}"]`);
                if (!$modal.length) return;
                $modal.removeClass('hidden').addClass('flex');
                $modal.find('[data-modal-content]').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
                $('body').addClass('overflow-hidden');
            },
            close($modal) {
                $modal.find('[data-modal-content]').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
                setTimeout(() => { $modal.removeClass('flex').addClass('hidden'); $('body').removeClass('overflow-hidden'); }, 200);
            }
        };

        // Form Validation
        const FormValidation = {
            rules: {
                required: (v) => v.trim() !== '',
                email: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
                minLength: (v, min) => v.length >= parseInt(min),
                phone: (v) => !v || /^[\d\s\-+()]{7,}$/.test(v)
            },
            messages: { required: 'This field is required', email: 'Please enter a valid email', minLength: (min) => `Must be at least ${min} characters`, phone: 'Please enter a valid phone number' },
            init() {
                $('form[data-validate]').on('submit', function(e) { if (!FormValidation.validateForm($(this))) e.preventDefault(); });
                $('form[data-validate] [data-rules]').on('blur', function() { FormValidation.validateField($(this)); });
                $('form[data-validate] [data-rules]').on('input', function() { FormValidation.clearError($(this)); });
            },
            validateForm($form) {
                let valid = true;
                $form.find('[data-rules]').each(function() { if (!FormValidation.validateField($(this))) valid = false; });
                return valid;
            },
            validateField($f) {
                const rules = $f.data('rules').split('|'), val = $f.val();
                for (const rule of rules) {
                    const [name, param] = rule.split(':');
                    if (this.rules[name] && !this.rules[name](val, param)) {
                        this.showError($f, typeof this.messages[name] === 'function' ? this.messages[name](param) : this.messages[name]);
                        return false;
                    }
                }
                this.clearError($f);
                return true;
            },
            showError($f, msg) { this.clearError($f); $f.addClass('!border-red-500'); $f.after(`<p class="form-error mt-1 text-sm text-red-500">${msg}</p>`); },
            clearError($f) { $f.removeClass('!border-red-500'); $f.siblings('.form-error').remove(); }
        };

        // Smooth Scrolling
        const SmoothScroll = {
            init() {
                $('a[href^="#"]:not([href="#"])').on('click', function(e) {
                    const $target = $($(this).attr('href'));
                    if ($target.length) {
                        e.preventDefault();
                        $('html, body').animate({ scrollTop: $target.offset().top - 80 }, 600);
                    }
                });
            }
        };

        // Loading States
        const LoadingState = {
            spinner: '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>',
            init() {
                $('form[data-loading]').on('submit', function() { LoadingState.start($(this).find('[type="submit"]')); });
            },
            start($btn) {
                if ($btn.data('loading')) return;
                $btn.data('loading', true).data('text', $btn.html()).prop('disabled', true).addClass('opacity-75 cursor-not-allowed').html(this.spinner + ($btn.data('loading-text') || 'Processing...'));
            },
            stop($btn) { $btn.data('loading', false).prop('disabled', false).removeClass('opacity-75 cursor-not-allowed').html($btn.data('text')); }
        };

        // Scroll to Top Button
        const ScrollTop = {
            init() {
                const $btn = $('#scroll-top-btn');
                if (!$btn.length) return;
                $(window).on('scroll', function() {
                    $(window).scrollTop() > 500 ? $btn.removeClass('opacity-0 invisible') : $btn.addClass('opacity-0 invisible');
                });
                $btn.on('click', () => $('html, body').animate({ scrollTop: 0 }, 600));
            }
        };

        // Sticky Header Shadow
        const StickyHeader = {
            init() {
                const $header = $('header').first();
                $(window).on('scroll', function() {
                    $(window).scrollTop() > 10 ? $header.addClass('shadow-lg') : $header.removeClass('shadow-lg');
                });
            }
        };

        // Initialize
        $(function() {
            MobileMenu.init();
            Modal.init();
            FormValidation.init();
            SmoothScroll.init();
            LoadingState.init();
            ScrollTop.init();
            StickyHeader.init();
            window.AppUI = { Modal, LoadingState };
        });
    })(jQuery);
    </script>
</body>
</html>
