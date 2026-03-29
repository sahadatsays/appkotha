<x-admin-layout>
    <x-slot name="title">Create Service</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.services.index') }}" class="text-gray-500 hover:text-gray-700">Services</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">Create</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Create Service</h1>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="name_en" class="block text-sm font-medium text-gray-700">Name (English) *</label>
                            <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="name_bn" class="block text-sm font-medium text-gray-700">Name (Bangla)</label>
                            <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name_bn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="auto-generated"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="tagline_en" class="block text-sm font-medium text-gray-700">Tagline (English)</label>
                            <input type="text" name="tagline_en" id="tagline_en" value="{{ old('tagline_en') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="tagline_bn" class="block text-sm font-medium text-gray-700">Tagline (Bangla)</label>
                            <input type="text" name="tagline_bn" id="tagline_bn" value="{{ old('tagline_bn') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="short_description_en" class="block text-sm font-medium text-gray-700">Short Description (English)</label>
                            <textarea name="short_description_en" id="short_description_en" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('short_description_en') }}</textarea>
                        </div>

                        <div>
                            <label for="short_description_bn" class="block text-sm font-medium text-gray-700">Short Description (Bangla)</label>
                            <textarea name="short_description_bn" id="short_description_bn" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('short_description_bn') }}</textarea>
                        </div>

                        <div>
                            <label for="description_en" class="block text-sm font-medium text-gray-700">Description (English)</label>
                            <textarea name="description_en" id="description_en" rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description_en') }}</textarea>
                        </div>

                        <div>
                            <label for="description_bn" class="block text-sm font-medium text-gray-700">Description (Bangla)</label>
                            <textarea name="description_bn" id="description_bn" rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description_bn') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Process Steps</h2>
                    <div>
                        <label for="process_steps_text" class="block text-sm font-medium text-gray-700">Steps (one per line)</label>
                        <textarea name="process_steps_text" id="process_steps_text" rows="6" placeholder="Step 1: Discovery&#10;Step 2: Design&#10;Step 3: Development"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('process_steps_text') }}</textarea>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">SEO</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title_en" class="block text-sm font-medium text-gray-700">Meta Title (English)</label>
                            <input type="text" name="meta_title_en" id="meta_title_en" value="{{ old('meta_title_en') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="meta_title_bn" class="block text-sm font-medium text-gray-700">Meta Title (Bangla)</label>
                            <input type="text" name="meta_title_bn" id="meta_title_bn" value="{{ old('meta_title_bn') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="meta_description_en" class="block text-sm font-medium text-gray-700">Meta Description (English)</label>
                            <textarea name="meta_description_en" id="meta_description_en" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description_en') }}</textarea>
                        </div>
                        <div>
                            <label for="meta_description_bn" class="block text-sm font-medium text-gray-700">Meta Description (Bangla)</label>
                            <textarea name="meta_description_bn" id="meta_description_bn" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description_bn') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Publish</h2>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_published" class="ml-2 block text-sm text-gray-700">Published</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured</label>
                        </div>

                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Create Service</button>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Pricing</h2>
                    <div>
                        <label for="starting_price" class="block text-sm font-medium text-gray-700">Starting Price (৳)</label>
                        <input type="number" name="starting_price" id="starting_price" value="{{ old('starting_price') }}" step="0.01" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Media</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Service Image</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
                            <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
