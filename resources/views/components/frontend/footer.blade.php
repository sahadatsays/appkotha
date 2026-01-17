<footer class="bg-neutral-900 text-white">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            <!-- Brand Column -->
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6">
                    <div class="w-10 h-10 bg-primary-500 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">a</span>
                    </div>
                    <span class="text-xl font-bold">app<span class="text-primary-400">Kotha</span></span>
                </a>
                <p class="text-neutral-400 text-sm leading-relaxed mb-6">
                    Premium digital products and custom software development services from Bangladesh. Trusted by 500+ clients globally.
                </p>
                <!-- Social Links -->
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-primary-500 rounded-lg flex items-center justify-center transition-colors" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5L14.17.5C10.24.5,9.25,3.11,9.25,5.32v2.15H6v4h3.25v12h5.25v-12h3.54Z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-primary-500 rounded-lg flex items-center justify-center transition-colors" aria-label="Twitter">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-primary-500 rounded-lg flex items-center justify-center transition-colors" aria-label="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-neutral-800 hover:bg-primary-500 rounded-lg flex items-center justify-center transition-colors" aria-label="GitHub">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Products Column -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-400 mb-6">Products</h3>
                <ul class="space-y-4">
                    @php
                        $footerProducts = \App\Models\Product::published()->take(5)->get();
                    @endphp
                    @forelse($footerProducts as $product)
                        <li>
                            <a href="{{ route('products.show', $product) }}" class="text-neutral-300 hover:text-white transition-colors">
                                {{ $product->name }}
                            </a>
                        </li>
                    @empty
                        <li><a href="{{ route('products.index') }}" class="text-neutral-300 hover:text-white transition-colors">All Products</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Services Column -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-400 mb-6">Services</h3>
                <ul class="space-y-4">
                    @php
                        $footerServices = \App\Models\Service::published()->take(5)->get();
                    @endphp
                    @forelse($footerServices as $service)
                        <li>
                            <a href="{{ route('services.show', $service) }}" class="text-neutral-300 hover:text-white transition-colors">
                                {{ $service->name }}
                            </a>
                        </li>
                    @empty
                        <li><a href="{{ route('services.index') }}" class="text-neutral-300 hover:text-white transition-colors">All Services</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Company Column -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-400 mb-6">Company</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}" class="text-neutral-300 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('portfolio') }}" class="text-neutral-300 hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-neutral-300 hover:text-white transition-colors">Blog</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-neutral-300 hover:text-white transition-colors">Contact</a></li>
                    <li><a href="{{ route('pricing') }}" class="text-neutral-300 hover:text-white transition-colors">Pricing</a></li>
                </ul>

                <!-- Contact Info -->
                <div class="mt-8 pt-6 border-t border-neutral-800">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-neutral-400 mb-4">Contact</h3>
                    <address class="not-italic space-y-2 text-sm text-neutral-400">
                        <p>Dhaka, Bangladesh</p>
                        <a href="mailto:hello@appkotha.com" class="block hover:text-white transition-colors">hello@appkotha.com</a>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-neutral-400">
                    © {{ date('Y') }} appKotha. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-sm text-neutral-400 hover:text-white transition-colors">Refund Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
