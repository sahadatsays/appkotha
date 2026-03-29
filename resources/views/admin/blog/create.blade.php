<x-admin-layout>
    <x-slot name="title">Create Blog Post</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.blog.index') }}" class="text-gray-500 hover:text-gray-700">Blog</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">New Post</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Create Blog Post</h1>
    </div>

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <div class="space-y-4">
                        <div>
                            <label for="title_en" class="block text-sm font-medium text-gray-700">Title (English) *</label>
                            <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('title_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="title_bn" class="block text-sm font-medium text-gray-700">Title (Bangla)</label>
                            <input type="text" name="title_bn" id="title_bn" value="{{ old('title_bn') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="auto-generated"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="excerpt_en" class="block text-sm font-medium text-gray-700">Excerpt (English)</label>
                            <textarea name="excerpt_en" id="excerpt_en" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt_en') }}</textarea>
                        </div>

                        <div>
                            <label for="excerpt_bn" class="block text-sm font-medium text-gray-700">Excerpt (Bangla)</label>
                            <textarea name="excerpt_bn" id="excerpt_bn" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt_bn') }}</textarea>
                        </div>

                        <div>
                            <label for="content_en" class="block text-sm font-medium text-gray-700">Content (English) *</label>
                            <textarea name="content_en" id="content_en" rows="15" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content_en') }}</textarea>
                            @error('content_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content_bn" class="block text-sm font-medium text-gray-700">Content (Bangla)</label>
                            <textarea name="content_bn" id="content_bn" rows="15"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content_bn') }}</textarea>
                        </div>
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
                            <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
                            <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Create Post</button>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Category</h2>
                    <select name="category_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">No Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h2>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
