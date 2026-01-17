<x-admin-layout>
    <x-slot name="title">Blog Categories</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Blog Categories</h1>
            <p class="mt-1 text-sm text-gray-500">Organize your blog posts with categories</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.blog.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">
                ← Back to Posts
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Add New Category -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Add New Category</h2>
            <form action="{{ route('admin.blog.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="auto-generated"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">
                    Add Category
                </button>
            </form>
        </div>

        <!-- Categories List -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-5 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">All Categories</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($categories as $category)
                    <div x-data="{ editing: false }" class="p-4">
                        <div x-show="!editing" class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $category->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $category->posts_count }} posts • /{{ $category->slug }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button @click="editing = true" class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</button>
                                @if($category->posts_count === 0)
                                    <form action="{{ route('admin.blog.categories.destroy', $category) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <form x-show="editing" action="{{ route('admin.blog.categories.update', $category) }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <div>
                                <input type="text" name="name" value="{{ $category->name }}" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            </div>
                            <div>
                                <input type="text" name="slug" value="{{ $category->slug }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            </div>
                            <div>
                                <textarea name="description" rows="2"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ $category->description }}</textarea>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="px-3 py-1 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">Save</button>
                                <button type="button" @click="editing = false" class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-md hover:bg-gray-200">Cancel</button>
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <p class="text-sm">No categories yet. Create your first one!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
