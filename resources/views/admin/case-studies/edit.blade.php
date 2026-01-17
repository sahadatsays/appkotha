<x-admin-layout>
    <x-slot name="title">Edit Case Study</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.case-studies.index') }}" class="text-gray-500 hover:text-gray-700">Case Studies</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">{{ Str::limit($caseStudy->title, 30) }}</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Edit Case Study</h1>
    </div>
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
            <h2 class="text-red-800 font-medium mb-2">Please fix the following errors:</h2>
            <ul class="list-disc list-inside text-red-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.case-studies.update', $caseStudy) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $caseStudy->title) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name *</label>
                                <input type="text" name="client" id="client_name" value="{{ old('client', $caseStudy->client) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                                <input type="text" name="industry" id="industry" value="{{ old('industry', $caseStudy->industry) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="project_duration" class="block text-sm font-medium text-gray-700">Project Duration</label>
                                <input type="text" name="project_duration" id="project_duration" value="{{ old('project_duration', $caseStudy->project_duration) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="project_url" class="block text-sm font-medium text-gray-700">Project URL</label>
                                <input type="url" name="project_url" id="project_url" value="{{ old('project_url', $caseStudy->project_url) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" rows="2"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $caseStudy->excerpt) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Case Study Content</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="challenge" class="block text-sm font-medium text-gray-700">Challenge</label>
                            <textarea name="challenge" id="challenge" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('challenge', $caseStudy->challenge) }}</textarea>
                        </div>
                        <div>
                            <label for="solution" class="block text-sm font-medium text-gray-700">Solution</label>
                            <textarea name="solution" id="solution" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('solution', $caseStudy->solution) }}</textarea>
                        </div>
                        <div>
                            <label for="results" class="block text-sm font-medium text-gray-700">Results</label>
                            <textarea name="results" id="results" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('results', $caseStudy->results) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Metrics & Testimonial</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="metrics" class="block text-sm font-medium text-gray-700">Key Metrics</label>
                            <p class="mt-1 text-xs text-gray-500">One metric per line</p>

                            <textarea name="metrics" id="metrics" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('metrics', is_array($caseStudy->metrics) ? implode("\n", array_filter($caseStudy->metrics, 'is_string')) : ($caseStudy->metrics ?? '')) }}</textarea>
                        </div>
                        <div>
                            <label for="testimonial" class="block text-sm font-medium text-gray-700">Client Testimonial</label>
                            <textarea name="testimonial" id="testimonial" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('testimonial', $caseStudy->testimonial) }}</textarea>
                        </div>
                        <div>
                            <label for="testimonial_author" class="block text-sm font-medium text-gray-700">Testimonial Author</label>
                            <input type="text" name="testimonial_author" id="testimonial_author" value="{{ old('testimonial_author', $caseStudy->testimonial_author) }}"
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
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $caseStudy->is_published) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_published" class="ml-2 block text-sm text-gray-700">Published</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $caseStudy->is_featured) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured</label>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.case-studies.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Update</button>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Tech Stack</h2>
                    <p class="text-xs text-gray-500 mb-2">One technology per line</p>
                    <textarea name="tech_stack" id="tech_stack" rows="6"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ old('tech_stack', is_array($caseStudy->tech_stack) ? implode("\n", $caseStudy->tech_stack) : $caseStudy->tech_stack) }}</textarea>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h2>
                    @if($caseStudy->featured_image)
                        <img src="{{ Storage::url($caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}" class="w-full h-32 object-cover rounded-lg mb-4">
                    @endif
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Gallery Images</h2>
                    @if($caseStudy->gallery && count($caseStudy->gallery) > 0)
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            @foreach($caseStudy->gallery as $image)
                                <img src="{{ Storage::url($image) }}" alt="Gallery" class="w-full h-20 object-cover rounded">
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6 border border-red-200">
                    <h2 class="text-lg font-medium text-red-600 mb-4">Danger Zone</h2>
                    <button type="button"
                        onclick="document.getElementById('delete-form').submit()"
                        class="w-full px-4 py-2 bg-red-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-red-700"
                        onclick="return confirm('Are you sure you want to delete this case study?')">
                        Delete Case Study
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete form moved outside the main form -->
    <form id="delete-form" action="{{ route('admin.case-studies.destroy', $caseStudy) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this case study?')" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-admin-layout>
