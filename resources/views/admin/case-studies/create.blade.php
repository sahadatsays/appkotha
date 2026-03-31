<x-admin-layout>
    <x-slot name="title">Create Case Study</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.case-studies.index') }}" class="text-gray-500 hover:text-gray-700">Case Studies</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">New Case Study</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Create Case Study</h1>
    </div>

    <form action="{{ route('admin.case-studies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>
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

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name *</label>
                                <input type="text" name="client_en" id="client_name" value="{{ old('client_en') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="client_bn" class="block text-sm font-medium text-gray-700">Client Name (Bangla)</label>
                                <input type="text" name="client_bn" id="client_bn" value="{{ old('client_bn') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="industry_en" class="block text-sm font-medium text-gray-700">Industry (English)</label>
                                <input type="text" name="industry_en" id="industry_en" value="{{ old('industry_en') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="industry_bn" class="block text-sm font-medium text-gray-700">Industry (Bangla)</label>
                                <input type="text" name="industry_bn" id="industry_bn" value="{{ old('industry_bn') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="excerpt_en" class="block text-sm font-medium text-gray-700">Excerpt (English)</label>
                            <textarea name="excerpt_en" id="excerpt_en" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt_en') }}</textarea>
                        </div>
                        <div>
                            <label for="excerpt_bn" class="block text-sm font-medium text-gray-700">Excerpt (Bangla)</label>
                            <textarea name="excerpt_bn" id="excerpt_bn" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt_bn') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Case Study Content</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="challenge_en" class="block text-sm font-medium text-gray-700">Challenge (English)</label>
                            <textarea name="challenge_en" id="challenge_en" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('challenge_en') }}</textarea>
                        </div>
                        <div>
                            <label for="challenge_bn" class="block text-sm font-medium text-gray-700">Challenge (Bangla)</label>
                            <textarea name="challenge_bn" id="challenge_bn" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('challenge_bn') }}</textarea>
                        </div>
                        <div>
                            <label for="solution_en" class="block text-sm font-medium text-gray-700">Solution (English)</label>
                            <textarea name="solution_en" id="solution_en" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('solution_en') }}</textarea>
                        </div>
                        <div>
                            <label for="solution_bn" class="block text-sm font-medium text-gray-700">Solution (Bangla)</label>
                            <textarea name="solution_bn" id="solution_bn" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('solution_bn') }}</textarea>
                        </div>
                        <div>
                            <label for="results_en" class="block text-sm font-medium text-gray-700">Results (English)</label>
                            <textarea name="results_en" id="results_en" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('results_en') }}</textarea>
                        </div>
                        <div>
                            <label for="results_bn" class="block text-sm font-medium text-gray-700">Results (Bangla)</label>
                            <textarea name="results_bn" id="results_bn" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('results_bn') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Metrics & Testimonial</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="metrics" class="block text-sm font-medium text-gray-700">Key Metrics</label>
                            <p class="mt-1 text-xs text-gray-500">One metric per line (e.g., "50% faster load times")</p>
                            <textarea name="metrics_text" id="metrics" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('metrics_text') }}</textarea>
                        </div>
                        <div>
                            <label for="testimonial_quote_en" class="block text-sm font-medium text-gray-700">Client Testimonial (English)</label>
                            <textarea name="testimonial_quote_en" id="testimonial_quote_en" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('testimonial_quote_en') }}</textarea>
                        </div>
                        <div>
                            <label for="testimonial_quote_bn" class="block text-sm font-medium text-gray-700">Client Testimonial (Bangla)</label>
                            <textarea name="testimonial_quote_bn" id="testimonial_quote_bn" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('testimonial_quote_bn') }}</textarea>
                        </div>
                        <div>
                            <label for="testimonial_author_en" class="block text-sm font-medium text-gray-700">Testimonial Author (English)</label>
                            <input type="text" name="testimonial_author_en" id="testimonial_author_en" value="{{ old('testimonial_author_en') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="testimonial_author_bn" class="block text-sm font-medium text-gray-700">Testimonial Author (Bangla)</label>
                            <input type="text" name="testimonial_author_bn" id="testimonial_author_bn" value="{{ old('testimonial_author_bn') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="testimonial_position_en" class="block text-sm font-medium text-gray-700">Testimonial Position (English)</label>
                            <input type="text" name="testimonial_position_en" id="testimonial_position_en" value="{{ old('testimonial_position_en') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="testimonial_position_bn" class="block text-sm font-medium text-gray-700">Testimonial Position (Bangla)</label>
                            <input type="text" name="testimonial_position_bn" id="testimonial_position_bn" value="{{ old('testimonial_position_bn') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.case-studies.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Create</button>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Tech Stack</h2>
                    <p class="text-xs text-gray-500 mb-2">One technology per line</p>
                    <textarea name="tech_stack_text" id="tech_stack" rows="6" placeholder="Laravel&#10;Vue.js&#10;MySQL&#10;Redis"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('tech_stack_text') }}</textarea>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h2>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Gallery Images</h2>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="mt-2 text-xs text-gray-500">You can select multiple images</p>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
