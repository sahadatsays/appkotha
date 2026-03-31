<x-admin-layout>
    <x-slot name="title">Add Team Member</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.team-members.index') }}" class="text-gray-500 hover:text-gray-700">Team Members</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">Add New</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Add Team Member</h1>
    </div>

    <form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Profile</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full name <span class="text-red-600">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. Sarah Ahmed"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">URL slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="e.g. sarah-ahmed (auto from name if empty)"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">Lowercase letters, numbers, and hyphens only.</p>
                                @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="designation" class="block text-sm font-medium text-gray-700">Designation <span class="text-red-600">*</span></label>
                            <input type="text" name="designation" id="designation" value="{{ old('designation') }}" required placeholder="e.g. Lead Software Engineer, CEO, Product Designer"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('designation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="short_bio" class="block text-sm font-medium text-gray-700">Short bio</label>
                            <textarea name="short_bio" id="short_bio" rows="3" placeholder="2–3 lines for cards on the team listing (optional)."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('short_bio') }}</textarea>
                            @error('short_bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="full_bio" class="block text-sm font-medium text-gray-700">Full bio <span class="text-red-600">*</span></label>
                            <textarea name="full_bio" id="full_bio" rows="10" required placeholder="Longer biography: background, focus areas, and how they help clients."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('full_bio') }}</textarea>
                            @error('full_bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Images</h2>
                    <p class="text-sm text-gray-600 mb-4">Provide a <strong>profile</strong> image by upload <em>or</em> a direct HTTPS URL. Cover image is optional.</p>
                    <div class="space-y-4">
                        <div>
                            <label for="profile_image_file" class="block text-sm font-medium text-gray-700">Profile image (upload)</label>
                            <input type="file" name="profile_image_file" id="profile_image_file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('profile_image_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="profile_image_url" class="block text-sm font-medium text-gray-700">Profile image (URL)</label>
                            <input type="url" name="profile_image_url" id="profile_image_url" value="{{ old('profile_image_url') }}" placeholder="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&amp;q=80"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Required if you do not upload a file. Use a square or portrait image for best results.</p>
                            @error('profile_image_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="cover_image_file" class="block text-sm font-medium text-gray-700">Cover image (upload)</label>
                            <input type="file" name="cover_image_file" id="cover_image_file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('cover_image_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="cover_image_url" class="block text-sm font-medium text-gray-700">Cover image (URL)</label>
                            <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url') }}" placeholder="https://images.unsplash.com/photo-1552664730-d307ca884978?w=1600&amp;q=80"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('cover_image_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Contact &amp; location</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="name@company.com"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="+880 1XXX-XXXXXX"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="e.g. Dhaka, Bangladesh"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="experience_years" class="block text-sm font-medium text-gray-700">Years of experience</label>
                            <input type="number" name="experience_years" id="experience_years" value="{{ old('experience_years') }}" min="0" max="80" placeholder="e.g. 8"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('experience_years') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Skills</h2>
                    <label for="skills_text" class="block text-sm font-medium text-gray-700">Skills (one per line)</label>
                    <textarea name="skills_text" id="skills_text" rows="6" placeholder="Laravel&#10;Tailwind CSS&#10;MySQL&#10;REST APIs"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">{{ old('skills_text') }}</textarea>
                    @error('skills_text') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Social links</h2>
                    <p class="text-sm text-gray-600 mb-4">Optional. Use full URLs including <code class="text-xs bg-gray-100 px-1 rounded">https://</code></p>
                    <div class="space-y-3">
                        <div>
                            <label for="social_linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                            <input type="url" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin') }}" placeholder="https://www.linkedin.com/in/username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_linkedin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="social_github" class="block text-sm font-medium text-gray-700">GitHub</label>
                            <input type="url" name="social_github" id="social_github" value="{{ old('social_github') }}" placeholder="https://github.com/username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_github') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="social_twitter" class="block text-sm font-medium text-gray-700">X (Twitter)</label>
                            <input type="url" name="social_twitter" id="social_twitter" value="{{ old('social_twitter') }}" placeholder="https://x.com/username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_twitter') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="social_website" class="block text-sm font-medium text-gray-700">Website</label>
                            <input type="url" name="social_website" id="social_website" value="{{ old('social_website') }}" placeholder="https://example.com"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Publish</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm text-gray-700">Active (visible on website)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured (highlight on team page)</label>
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" placeholder="0 = first"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.team-members.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
