<x-layouts.frontend title="Message Sent">
    <section class="py-32 bg-white">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-neutral-900 mb-4">Message Sent!</h1>
            <p class="text-xl text-neutral-600 mb-8">
                Thank you for reaching out. We'll get back to you within 24 hours.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition-colors">
                Back to Home
            </a>
        </div>
    </section>
</x-layouts.frontend>
