<x-admin-layout>
    <x-slot name="title">Create Setting</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.settings.index') }}" class="text-gray-500 hover:text-gray-700">Settings</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">Create</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Create Setting</h1>
    </div>

    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data" x-data="{ selectedType: '{{ old('type', 'text') }}' }">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Setting Information -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Setting Information</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="group" class="block text-sm font-medium text-gray-700">Group *</label>
                            <select name="group" id="group" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select group</option>
                                @foreach($groups as $key => $label)
                                    <option value="{{ $key }}" {{ old('group') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('group') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="key" class="block text-sm font-medium text-gray-700">Key *</label>
                            <input type="text" name="key" id="key" value="{{ old('key') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., company_name">
                            <p class="mt-1 text-xs text-gray-500">Use lowercase with underscores</p>
                            @error('key') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                            <input type="text" name="label" id="label" value="{{ old('label') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Human readable name">
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type *</label>
                            <select name="type" id="type" required x-model="selectedType"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', 'text') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Setting Value -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Value</h2>

                    <!-- Text Input -->
                    <div x-show="['text', 'url', 'number'].includes(selectedType)">
                        <label for="value_text" class="block text-sm font-medium text-gray-700">Value</label>
                        <input type="text" name="value" id="value_text" value="{{ old('value') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Textarea -->
                    <div x-show="selectedType === 'textarea'">
                        <label for="value_textarea" class="block text-sm font-medium text-gray-700">Value</label>
                        <textarea name="value" id="value_textarea" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('value') }}</textarea>
                    </div>

                    <!-- Rich Text -->
                    <div x-show="selectedType === 'richtext'">
                        <label for="value_richtext" class="block text-sm font-medium text-gray-700">Value</label>
                        <textarea name="value" id="value_richtext" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('value') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">HTML is allowed</p>
                    </div>

                    <!-- Color -->
                    <div x-show="selectedType === 'color'">
                        <label for="value_color" class="block text-sm font-medium text-gray-700">Value</label>
                        <div class="mt-1 flex items-center space-x-3">
                            <input type="color" name="value" id="value_color" value="{{ old('value', '#000000') }}"
                                class="h-10 w-20 rounded border-gray-300">
                            <input type="text" id="color_text" value="{{ old('value', '#000000') }}"
                                class="block w-32 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                oninput="document.getElementById('value_color').value = this.value">
                        </div>
                    </div>

                    <!-- Image -->
                    <div x-show="selectedType === 'image'">
                        <label for="value_image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="value" id="value_image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <!-- Boolean -->
                    <div x-show="selectedType === 'boolean'">
                        <div class="flex items-center">
                            <input type="checkbox" name="value" id="value_boolean" value="1" {{ old('value') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="value_boolean" class="ml-2 block text-sm text-gray-700">Enabled</label>
                        </div>
                    </div>

                    <!-- JSON -->
                    <div x-show="selectedType === 'json'">
                        <label for="value_json" class="block text-sm font-medium text-gray-700">Value (JSON)</label>
                        <textarea name="value" id="value_json" rows="6"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm"
                            placeholder='{"key": "value"}'>{{ old('value') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Enter valid JSON</p>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Brief description of this setting">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Actions -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Actions</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">
                            Create Setting
                        </button>
                    </div>
                </div>

                <!-- Help -->
                <div class="bg-blue-50 shadow-sm rounded-lg p-6">
                    <h3 class="text-sm font-medium text-blue-800 mb-2">Tips</h3>
                    <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
                        <li>Use descriptive keys like <code class="text-xs bg-blue-100 px-1 rounded">company_name</code></li>
                        <li>Group related settings together</li>
                        <li>Add labels for better readability</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
