<x-layouts.frontend title="Create Ticket">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="saas-card p-6">
                    <h1 class="text-2xl font-bold">Create Support Ticket</h1>
                    <p class="theme-text-secondary text-sm mt-1">Give us details and we will respond as soon as possible.</p>

                    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5">
                        @csrf
                        <div>
                            <label for="subject" class="block text-sm font-medium mb-2">Subject</label>
                            <input id="subject" name="subject" type="text" value="{{ old('subject') }}" class="w-full rounded-xl" required>
                            @error('subject')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="category" class="block text-sm font-medium mb-2">Category</label>
                                <select id="category" name="category" class="w-full rounded-xl" required>
                                    <option value="">Choose category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('category')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="priority" class="block text-sm font-medium mb-2">Priority</label>
                                <select id="priority" name="priority" class="w-full rounded-xl" required>
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->value }}" @selected(old('priority', 'medium') === $priority->value)>{{ $priority->label() }}</option>
                                    @endforeach
                                </select>
                                @error('priority')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium mb-2">Message</label>
                            <textarea id="message" name="message" rows="6" class="w-full rounded-xl" required>{{ old('message') }}</textarea>
                            @error('message')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="attachment" class="block text-sm font-medium mb-2">Attachment (optional)</label>
                            <input id="attachment" name="attachment" type="file" class="w-full rounded-xl">
                            <p class="text-xs theme-text-secondary mt-1">PNG, JPG, PDF or docs up to 5MB.</p>
                            @error('attachment')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" class="saas-btn-primary px-5 py-2.5 text-sm font-semibold">Submit Ticket</button>
                            <a href="{{ route('tickets.index') }}" class="saas-btn-secondary px-5 py-2.5 text-sm font-semibold">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
