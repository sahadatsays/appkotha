<x-layouts.frontend title="Request a Demo">
    {{-- Hero Section --}}
    <section class="py-20 lg:py-28 bg-gradient-to-br from-neutral-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                {{-- Info --}}
                <div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
                        Request a Demo
                    </h1>
                    <p class="text-xl text-neutral-600 mb-8">
                        See our products in action. Schedule a personalized demo with our team.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900">Live Demo</h3>
                                <p class="text-neutral-600">30-minute personalized walkthrough</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-neutral-900">Q&A Session</h3>
                                <p class="text-neutral-600">Ask anything about our products</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Demo Form --}}
                <div class="bg-white rounded-2xl p-8 shadow-elevated">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.demo.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-neutral-700 mb-2">Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-neutral-700 mb-2">Phone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                            </div>
                            <div>
                                <label for="company" class="block text-sm font-medium text-neutral-700 mb-2">Company</label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}" class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-neutral-700 mb-2">Product of Interest</label>
                            <select name="subject" id="subject" class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                                <option value="">Select a product</option>
                                <option value="All Products">All Products Overview</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-neutral-700 mb-2">Additional Notes</label>
                            <textarea name="message" id="message" rows="4" class="w-full px-4 py-3 rounded-xl border border-neutral-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors resize-none">{{ old('message') }}</textarea>
                        </div>

                        <input type="hidden" name="message_type" value="demo">

                        <button type="submit" class="w-full px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                            Request Demo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
