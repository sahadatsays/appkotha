<x-layouts.frontend title="Order Lookup">
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800 min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white mb-4">Find Your Order</h1>
                <p class="text-neutral-600 dark:text-neutral-400">
                    Enter your order number and email to view your order details and download your products.
                </p>
            </div>

            {{-- Lookup Form --}}
            <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-soft dark:shadow-none dark:border dark:border-neutral-700 p-8" data-aos="fade-up" data-aos-delay="100">
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                        <p class="text-sm text-red-600 dark:text-red-400 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ session('error') }}
                        </p>
                    </div>
                @endif

                <form action="{{ route('checkout.lookup') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Order Number --}}
                    <div>
                        <label for="order_number" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Order Number <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="order_number"
                            name="order_number"
                            value="{{ old('order_number') }}"
                            required
                            placeholder="e.g., AK250117XXXX"
                            class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all @error('order_number') border-red-500 @enderror"
                        >
                        @error('order_number')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="The email used for your order"
                            class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg btn-shine"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Find My Order
                    </button>
                </form>

                {{-- Help Text --}}
                <div class="mt-8 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center">
                        Can't find your order? Check your email for the order confirmation or contact
                        <a href="mailto:support@appkotha.com" class="text-primary-600 dark:text-primary-400 hover:underline">support@appkotha.com</a>
                    </p>
                </div>
            </div>

            {{-- Account Login Prompt --}}
            @guest
                <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-neutral-600 dark:text-neutral-400 mb-4">
                        Have an account? Access all your orders easily.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Sign in to your account
                    </a>
                </div>
            @endguest
        </div>
    </section>
</x-layouts.frontend>
