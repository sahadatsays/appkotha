<x-layouts.frontend title="Checkout">
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-12" data-aos="fade-up">
                <h1 class="text-4xl font-bold text-neutral-900 dark:text-white mb-4">Checkout</h1>
                <p class="text-neutral-600 dark:text-neutral-400">Complete your purchase to receive instant access</p>
            </div>

            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="grid lg:grid-cols-3 gap-8">
                    {{-- Checkout Form --}}
                    <div class="lg:col-span-2 space-y-6" data-aos="fade-up" data-aos-delay="100">
                        {{-- Customer Information --}}
                        <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700">
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-6 flex items-center gap-3">
                                <span class="w-8 h-8 bg-primary-500 text-white rounded-full flex items-center justify-center text-sm font-bold">1</span>
                                Customer Information
                            </h2>

                            <div class="grid md:grid-cols-2 gap-6">
                                {{-- Name --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', auth()->user()->name ?? '') }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all @error('name') border-red-500 @enderror"
                                    >
                                    @error('name')
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
                                        value="{{ old('email', auth()->user()->email ?? '') }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all @error('email') border-red-500 @enderror"
                                    >
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">
                                        License and download links will be sent here
                                    </p>
                                </div>

                                {{-- Phone (Optional) --}}
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                        Phone Number <span class="text-neutral-400">(Optional)</span>
                                    </label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    >
                                </div>

                                {{-- Country --}}
                                <div>
                                    <label for="country" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                        Country <span class="text-neutral-400">(Optional)</span>
                                    </label>
                                    <select
                                        id="country"
                                        name="country"
                                        class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    >
                                        <option value="">Select Country</option>
                                        <option value="BD" {{ old('country') == 'BD' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States</option>
                                        <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                        <option value="AU" {{ old('country') == 'AU' ? 'selected' : '' }}>Australia</option>
                                        <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                                        <option value="other" {{ old('country') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div class="mt-6">
                                <label for="notes" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                    Order Notes <span class="text-neutral-400">(Optional)</span>
                                </label>
                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="3"
                                    placeholder="Any special instructions or notes for your order..."
                                    class="w-full px-4 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                                >{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700">
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-6 flex items-center gap-3">
                                <span class="w-8 h-8 bg-primary-500 text-white rounded-full flex items-center justify-center text-sm font-bold">2</span>
                                Payment Method
                            </h2>

                            <div class="space-y-4">
                                {{-- Bank Transfer --}}
                                <label class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all payment-option {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-neutral-200 dark:border-neutral-700 hover:border-primary-300 dark:hover:border-primary-700' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="bank_transfer"
                                        {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'checked' : '' }}
                                        class="mt-1 w-5 h-5 text-primary-600 focus:ring-primary-500"
                                    >
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <span class="font-semibold text-neutral-900 dark:text-white">Bank Transfer</span>
                                        </div>
                                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                                            Pay via bank transfer. Order will be processed after payment confirmation.
                                        </p>
                                    </div>
                                </label>

                                {{-- bKash/Mobile Banking --}}
                                <label class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all payment-option {{ old('payment_method') == 'manual' ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-neutral-200 dark:border-neutral-700 hover:border-primary-300 dark:hover:border-primary-700' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="manual"
                                        {{ old('payment_method') == 'manual' ? 'checked' : '' }}
                                        class="mt-1 w-5 h-5 text-primary-600 focus:ring-primary-500"
                                    >
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-semibold text-neutral-900 dark:text-white">Mobile Banking (bKash/Nagad/Rocket)</span>
                                        </div>
                                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                                            Pay via bKash, Nagad, or Rocket. Instructions will be provided after order.
                                        </p>
                                    </div>
                                </label>

                                {{-- Stripe (Coming Soon) --}}
                                <label class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-not-allowed transition-all border-neutral-200 dark:border-neutral-700 opacity-60">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="stripe"
                                        disabled
                                        class="mt-1 w-5 h-5 text-primary-600 focus:ring-primary-500"
                                    >
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                            </svg>
                                            <span class="font-semibold text-neutral-900 dark:text-white">Credit/Debit Card</span>
                                            <span class="px-2 py-0.5 bg-neutral-200 dark:bg-neutral-700 text-neutral-600 dark:text-neutral-400 text-xs rounded-full">Coming Soon</span>
                                        </div>
                                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                                            Pay securely with Stripe. Visa, Mastercard, Amex accepted.
                                        </p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Terms & Conditions --}}
                        <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input
                                    type="checkbox"
                                    name="terms"
                                    id="terms"
                                    required
                                    class="mt-1 w-5 h-5 text-primary-600 focus:ring-primary-500 rounded"
                                >
                                <span class="text-sm text-neutral-600 dark:text-neutral-400">
                                    I agree to the <a href="{{ route('pages.terms') }}" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">Terms & Conditions</a>
                                    and <a href="{{ route('pages.privacy') }}" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">Privacy Policy</a>.
                                    I understand that digital products are non-refundable after download.
                                </span>
                            </label>
                            @error('terms')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="lg:col-span-1" data-aos="fade-up" data-aos-delay="200">
                        <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700 sticky top-24">
                            <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-6">Order Summary</h2>

                            {{-- Cart Items --}}
                            <div class="space-y-4 mb-6">
                                @foreach($cart['items'] as $item)
                                    <div class="flex gap-4">
                                        <div class="w-16 h-16 bg-neutral-100 dark:bg-neutral-700 rounded-lg flex-shrink-0 overflow-hidden">
                                            @if($item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-medium text-neutral-900 dark:text-white text-sm">{{ $item['name'] }}</h4>
                                            <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ ucfirst(str_replace('-', ' ', $item['license_type'])) }} License</p>
                                            <p class="text-sm font-semibold text-neutral-900 dark:text-white mt-1">${{ number_format($item['price'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="border-neutral-200 dark:border-neutral-700 mb-6">

                            {{-- Totals --}}
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-neutral-600 dark:text-neutral-400">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($cart['subtotal'], 2) }}</span>
                                </div>
                                @if($cart['discount'] > 0)
                                    <div class="flex justify-between text-green-600 dark:text-green-400">
                                        <span>Discount</span>
                                        <span>-${{ number_format($cart['discount'], 2) }}</span>
                                    </div>
                                @endif
                                <hr class="border-neutral-200 dark:border-neutral-700">
                                <div class="flex justify-between text-lg font-bold text-neutral-900 dark:text-white">
                                    <span>Total</span>
                                    <span>${{ number_format($cart['total'], 2) }}</span>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button
                                type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:shadow-lg btn-shine disabled:opacity-50 disabled:cursor-not-allowed"
                                id="checkout-btn"
                            >
                                <span id="btn-text">Complete Order</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <svg class="w-5 h-5 animate-spin hidden" id="btn-spinner" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>

                            {{-- Security Note --}}
                            <div class="mt-6 space-y-3">
                                <div class="flex items-center gap-3 text-sm text-neutral-500 dark:text-neutral-400">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    <span>Secure checkout</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-neutral-500 dark:text-neutral-400">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    <span>Your data is encrypted</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-neutral-500 dark:text-neutral-400">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    <span>Instant download after payment</span>
                                </div>
                            </div>

                            {{-- Back to Cart --}}
                            <div class="mt-6 text-center">
                                <a href="{{ route('cart.index') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">
                                    ← Back to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Payment method selection styling
            $('input[name="payment_method"]').change(function() {
                $('.payment-option').removeClass('border-primary-500 bg-primary-50 dark:bg-primary-900/20')
                    .addClass('border-neutral-200 dark:border-neutral-700');
                $(this).closest('.payment-option')
                    .removeClass('border-neutral-200 dark:border-neutral-700')
                    .addClass('border-primary-500 bg-primary-50 dark:bg-primary-900/20');
            });

            // Form submission
            $('#checkout-form').on('submit', function() {
                $('#checkout-btn').prop('disabled', true);
                $('#btn-text').text('Processing...');
                $('#btn-spinner').removeClass('hidden');
            });
        });
    </script>
    @endpush
</x-layouts.frontend>
