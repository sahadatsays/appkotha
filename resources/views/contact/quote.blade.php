<x-layouts.frontend title="Get a Quote">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                {{-- Info --}}
                <div data-aos="fade-right">
                    <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 dark:text-white mb-6">
                        Request a Quote
                    </h1>
                    <p class="text-xl text-neutral-600 dark:text-neutral-400 mb-8">
                        Tell us about your project and we'll get back to you with a detailed proposal and timeline within 48 hours.
                    </p>

                    <div class="bg-white dark:bg-neutral-800 rounded-2xl p-6 shadow-soft dark:shadow-none dark:border dark:border-neutral-700 mb-8 hover-lift" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="font-bold text-neutral-900 dark:text-white mb-4">What happens next?</h3>
                        <ol class="space-y-4">
                            <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="150">
                                <span class="w-6 h-6 bg-primary-500 text-white rounded-full flex items-center justify-center text-sm font-semibold shrink-0 animate-pulse-soft">1</span>
                                <p class="text-neutral-600 dark:text-neutral-400">We review your requirements within 24 hours</p>
                            </li>
                            <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="200">
                                <span class="w-6 h-6 bg-primary-500 text-white rounded-full flex items-center justify-center text-sm font-semibold shrink-0 animate-pulse-soft">2</span>
                                <p class="text-neutral-600 dark:text-neutral-400">Schedule a free consultation call</p>
                            </li>
                            <li class="flex items-start gap-3" data-aos="fade-up" data-aos-delay="250">
                                <span class="w-6 h-6 bg-primary-500 text-white rounded-full flex items-center justify-center text-sm font-semibold shrink-0 animate-pulse-soft">3</span>
                                <p class="text-neutral-600 dark:text-neutral-400">Receive a detailed proposal with pricing</p>
                            </li>
                        </ol>
                    </div>

                    <div class="flex items-center gap-4 text-sm text-neutral-500 dark:text-neutral-400" data-aos="fade-up" data-aos-delay="300">
                        <svg class="w-5 h-5 text-green-500 animate-bounce-soft" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>No commitment required • Free consultation</span>
                    </div>
                </div>

                {{-- Quote Form --}}
                <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 shadow-elevated dark:shadow-none dark:border dark:border-neutral-700 hover-lift" data-aos="fade-left" data-aos-delay="100">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 rounded-xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.quote.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 hover:border-primary-300 dark:hover:border-primary-600 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 hover:border-primary-300 dark:hover:border-primary-600 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Phone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-xl border border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 hover:border-primary-300 dark:hover:border-primary-600">
                            </div>
                            <div>
                                <label for="company" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Company</label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}" class="w-full px-4 py-3 rounded-xl border border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 hover:border-primary-300 dark:hover:border-primary-600">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Project Type</label>
                            <select name="subject" id="subject" class="w-full px-4 py-3 rounded-xl border border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                                <option value="">Select a project type</option>
                                <option value="Web Application" {{ old('subject') == 'Web Application' ? 'selected' : '' }}>Web Application</option>
                                <option value="Mobile App" {{ old('subject') == 'Mobile App' ? 'selected' : '' }}>Mobile App (iOS/Android)</option>
                                <option value="E-Commerce" {{ old('subject') == 'E-Commerce' ? 'selected' : '' }}>E-Commerce Platform</option>
                                <option value="SaaS Product" {{ old('subject') == 'SaaS Product' ? 'selected' : '' }}>SaaS Product</option>
                                <option value="API Development" {{ old('subject') == 'API Development' ? 'selected' : '' }}>API Development</option>
                                <option value="MVP Development" {{ old('subject') == 'MVP Development' ? 'selected' : '' }}>MVP Development</option>
                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Project Description *</label>
                            <textarea name="message" id="message" rows="6" required placeholder="Tell us about your project. What problem are you trying to solve? What features do you need? What's your timeline and budget?" class="w-full px-4 py-3 rounded-xl border border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-400 dark:placeholder-neutral-500 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="message_type" value="quote">

                        <button type="submit" class="w-full px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg btn-shine">
                            Submit Quote Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
