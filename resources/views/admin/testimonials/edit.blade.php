<x-admin-layout>
    <x-slot name="title">Edit Testimonial</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.testimonials.index') }}" class="text-gray-500 hover:text-gray-700">Testimonials</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">{{ $testimonial->name_en ?? $testimonial->name }}</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Edit Testimonial</h1>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name_en" class="block text-sm font-medium text-gray-700">Name (English) *</label>
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $testimonial->name_en) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="name_bn" class="block text-sm font-medium text-gray-700">Name (Bangla)</label>
                                <input type="text" name="name_bn" id="name_bn" value="{{ old('name_bn', $testimonial->name_bn) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="position_en" class="block text-sm font-medium text-gray-700">Position (English)</label>
                                <input type="text" name="position_en" id="position_en" value="{{ old('position_en', $testimonial->position_en) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="position_bn" class="block text-sm font-medium text-gray-700">Position (Bangla)</label>
                                <input type="text" name="position_bn" id="position_bn" value="{{ old('position_bn', $testimonial->position_bn) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="company_en" class="block text-sm font-medium text-gray-700">Company (English)</label>
                                <input type="text" name="company_en" id="company_en" value="{{ old('company_en', $testimonial->company_en) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="company_bn" class="block text-sm font-medium text-gray-700">Company (Bangla)</label>
                                <input type="text" name="company_bn" id="company_bn" value="{{ old('company_bn', $testimonial->company_bn) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="content_en" class="block text-sm font-medium text-gray-700">Testimonial (English) *</label>
                            <textarea name="content_en" id="content_en" rows="5" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content_en', $testimonial->content_en) }}</textarea>
                            @error('content_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content_bn" class="block text-sm font-medium text-gray-700">Testimonial (Bangla)</label>
                            <textarea name="content_bn" id="content_bn" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content_bn', $testimonial->content_bn) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating *</label>
                            <div x-data="{ rating: {{ old('rating', $testimonial->rating) }} }" class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" @click="rating = {{ $i }}"
                                        :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"
                                        class="h-8 w-8 focus:outline-none">
                                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                @endfor
                                <input type="hidden" name="rating" x-model="rating">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Publish</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $testimonial->is_published) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_published" class="ml-2 block text-sm text-gray-700">Published</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured</label>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Update</button>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Avatar</h2>
                    @if($testimonial->image)
                        <div class="mb-4 flex justify-center">
                            <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->name }}" class="h-24 w-24 rounded-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6 border border-red-200">
                    <h2 class="text-lg font-medium text-red-600 mb-4">Danger Zone</h2>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700">Delete Testimonial</button>
                    </form>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
