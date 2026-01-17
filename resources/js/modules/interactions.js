/**
 * jQuery Interactions Module
 * Clean, minimal jQuery code for common UI interactions
 */

(function($) {
    'use strict';

    // ===========================================
    // 1. MOBILE MENU
    // ===========================================
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

            // Close on ESC key
            $(document).on('keydown', (e) => {
                if (e.key === 'Escape') this.close();
            });

            // Close on link click
            this.$menu.find('a').on('click', () => this.close());
        },

        open() {
            this.$menu.removeClass('translate-x-full');
            this.$overlay.removeClass('hidden').addClass('opacity-100');
            $('body').addClass('overflow-hidden');
        },

        close() {
            this.$menu.addClass('translate-x-full');
            this.$overlay.addClass('hidden').removeClass('opacity-100');
            $('body').removeClass('overflow-hidden');
        }
    };

    // ===========================================
    // 2. MODAL DIALOGS
    // ===========================================
    const Modal = {
        init() {
            this.bindEvents();
        },

        bindEvents() {
            // Open modal
            $('[data-modal-open]').on('click', function(e) {
                e.preventDefault();
                const modalId = $(this).data('modal-open');
                Modal.open(modalId);
            });

            // Close modal
            $(document).on('click', '[data-modal-close]', function() {
                const $modal = $(this).closest('[data-modal]');
                Modal.close($modal);
            });

            // Close on backdrop click
            $(document).on('click', '[data-modal]', function(e) {
                if (e.target === this) {
                    Modal.close($(this));
                }
            });

            // Close on ESC
            $(document).on('keydown', (e) => {
                if (e.key === 'Escape') {
                    $('[data-modal]:visible').each(function() {
                        Modal.close($(this));
                    });
                }
            });
        },

        open(id) {
            const $modal = $(`[data-modal="${id}"]`);
            if (!$modal.length) return;

            $modal.removeClass('hidden').addClass('flex');
            $modal.find('[data-modal-content]')
                .removeClass('scale-95 opacity-0')
                .addClass('scale-100 opacity-100');
            $('body').addClass('overflow-hidden');

            // Focus trap
            $modal.find('input, button, a').first().focus();
        },

        close($modal) {
            if (!$modal.length) return;

            $modal.find('[data-modal-content]')
                .removeClass('scale-100 opacity-100')
                .addClass('scale-95 opacity-0');

            setTimeout(() => {
                $modal.removeClass('flex').addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }, 200);
        }
    };

    // ===========================================
    // 3. FORM VALIDATION
    // ===========================================
    const FormValidation = {
        rules: {
            required: (value) => value.trim() !== '',
            email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
            minLength: (value, min) => value.length >= min,
            phone: (value) => !value || /^[\d\s\-+()]{7,}$/.test(value)
        },

        messages: {
            required: 'This field is required',
            email: 'Please enter a valid email address',
            minLength: (min) => `Must be at least ${min} characters`,
            phone: 'Please enter a valid phone number'
        },

        init() {
            this.bindEvents();
        },

        bindEvents() {
            // Validate on form submit
            $('form[data-validate]').on('submit', function(e) {
                const $form = $(this);
                if (!FormValidation.validateForm($form)) {
                    e.preventDefault();
                }
            });

            // Real-time validation on blur
            $('form[data-validate] [data-rules]').on('blur', function() {
                FormValidation.validateField($(this));
            });

            // Clear error on input
            $('form[data-validate] [data-rules]').on('input', function() {
                FormValidation.clearError($(this));
            });
        },

        validateForm($form) {
            let isValid = true;
            $form.find('[data-rules]').each(function() {
                if (!FormValidation.validateField($(this))) {
                    isValid = false;
                }
            });
            return isValid;
        },

        validateField($field) {
            const rules = $field.data('rules').split('|');
            const value = $field.val();

            for (const rule of rules) {
                const [ruleName, ruleParam] = rule.split(':');

                if (this.rules[ruleName]) {
                    const isValid = this.rules[ruleName](value, ruleParam);
                    if (!isValid) {
                        const message = typeof this.messages[ruleName] === 'function'
                            ? this.messages[ruleName](ruleParam)
                            : this.messages[ruleName];
                        this.showError($field, message);
                        return false;
                    }
                }
            }

            this.clearError($field);
            return true;
        },

        showError($field, message) {
            this.clearError($field);
            $field.addClass('border-red-500 focus:border-red-500 focus:ring-red-500/20');
            $field.after(`<p class="form-error mt-1 text-sm text-red-600 dark:text-red-400">${message}</p>`);
        },

        clearError($field) {
            $field.removeClass('border-red-500 focus:border-red-500 focus:ring-red-500/20');
            $field.siblings('.form-error').remove();
        }
    };

    // ===========================================
    // 4. SMOOTH SCROLLING
    // ===========================================
    const SmoothScroll = {
        init() {
            this.bindEvents();
        },

        bindEvents() {
            $('a[href^="#"]:not([href="#"])').on('click', function(e) {
                const target = $($(this).attr('href'));
                if (target.length) {
                    e.preventDefault();
                    SmoothScroll.scrollTo(target);
                }
            });
        },

        scrollTo($target, offset = 80) {
            const position = $target.offset().top - offset;

            $('html, body').animate({
                scrollTop: position
            }, {
                duration: 600,
                easing: 'swing',
                complete: () => {
                    // Update URL hash without jumping
                    history.pushState(null, null, '#' + $target.attr('id'));
                }
            });
        }
    };

    // ===========================================
    // 5. LOADING STATES
    // ===========================================
    const LoadingState = {
        spinner: `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>`,

        init() {
            this.bindEvents();
        },

        bindEvents() {
            // Auto-loading on form submit
            $('form[data-loading]').on('submit', function() {
                const $btn = $(this).find('[type="submit"]');
                LoadingState.start($btn);
            });

            // Manual loading trigger
            $('[data-loading-trigger]').on('click', function() {
                LoadingState.start($(this));
            });
        },

        start($btn) {
            if ($btn.data('loading-active')) return;

            const originalText = $btn.html();
            const loadingText = $btn.data('loading-text') || 'Processing...';

            $btn.data('loading-active', true)
                .data('original-text', originalText)
                .prop('disabled', true)
                .addClass('opacity-75 cursor-not-allowed')
                .html(this.spinner + loadingText);
        },

        stop($btn) {
            const originalText = $btn.data('original-text');

            $btn.data('loading-active', false)
                .prop('disabled', false)
                .removeClass('opacity-75 cursor-not-allowed')
                .html(originalText);
        }
    };

    // ===========================================
    // 6. UTILITY FUNCTIONS
    // ===========================================
    const Utils = {
        // Debounce function
        debounce(func, wait = 300) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        },

        // Scroll to top
        initScrollToTop() {
            const $btn = $('[data-scroll-top]');
            if (!$btn.length) return;

            $(window).on('scroll', Utils.debounce(() => {
                if ($(window).scrollTop() > 500) {
                    $btn.removeClass('opacity-0 invisible').addClass('opacity-100 visible');
                } else {
                    $btn.removeClass('opacity-100 visible').addClass('opacity-0 invisible');
                }
            }, 100));

            $btn.on('click', () => {
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        },

        // Sticky header shadow on scroll
        initStickyHeader() {
            const $header = $('header').first();
            if (!$header.length) return;

            $(window).on('scroll', Utils.debounce(() => {
                if ($(window).scrollTop() > 10) {
                    $header.addClass('shadow-md');
                } else {
                    $header.removeClass('shadow-md');
                }
            }, 50));
        }
    };

    // ===========================================
    // INITIALIZE ALL MODULES
    // ===========================================
    $(document).ready(function() {
        MobileMenu.init();
        Modal.init();
        FormValidation.init();
        SmoothScroll.init();
        LoadingState.init();
        Utils.initScrollToTop();
        Utils.initStickyHeader();

        // Expose for external use
        window.AppInteractions = {
            Modal,
            LoadingState,
            FormValidation
        };
    });

})(jQuery);
