@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;

    $profileUrlOld = old('profile_image_url');
    if ($profileUrlOld === null && Str::startsWith($teamMember->profile_image, ['http://', 'https://'])) {
        $profileUrlOld = $teamMember->profile_image;
    }

    $coverUrlOld = old('cover_image_url');
    if ($coverUrlOld === null && $teamMember->cover_image && Str::startsWith($teamMember->cover_image, ['http://', 'https://'])) {
        $coverUrlOld = $teamMember->cover_image;
    }

    $profilePreview = Str::startsWith($teamMember->profile_image, ['http://', 'https://'])
        ? $teamMember->profile_image
        : Storage::url($teamMember->profile_image);

    $coverPreview = $teamMember->cover_image
        ? (Str::startsWith($teamMember->cover_image, ['http://', 'https://']) ? $teamMember->cover_image : Storage::url($teamMember->cover_image))
        : null;

    $skillsDefault = old('skills_text');
    if ($skillsDefault === null) {
        $skillsDefault = is_array($teamMember->skills) ? implode("\n", $teamMember->skills) : '';
    }
@endphp

<x-admin-layout>
    <x-slot name="title">Edit Team Member</x-slot>

    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('admin.team-members.index') }}" class="text-gray-500 hover:text-gray-700">Team Members</a></li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium truncate max-w-xs">{{ $teamMember->name }}</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900">Edit Team Member</h1>
    </div>

    <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Profile</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full name <span class="text-red-600">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $teamMember->name) }}" required placeholder="e.g. Sarah Ahmed"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">URL slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $teamMember->slug) }}" placeholder="e.g. sarah-ahmed"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="designation" class="block text-sm font-medium text-gray-700">Designation <span class="text-red-600">*</span></label>
                            <input type="text" name="designation" id="designation" value="{{ old('designation', $teamMember->designation) }}" required placeholder="e.g. Lead Software Engineer"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('designation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="short_bio" class="block text-sm font-medium text-gray-700">Short bio</label>
                            <textarea name="short_bio" id="short_bio" rows="3" placeholder="2–3 lines for team cards."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('short_bio', $teamMember->short_bio) }}</textarea>
                            @error('short_bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="full_bio" class="block text-sm font-medium text-gray-700">Full bio <span class="text-red-600">*</span></label>
                            <textarea name="full_bio" id="full_bio" rows="10" required placeholder="Longer biography for the profile page."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('full_bio', $teamMember->full_bio) }}</textarea>
                            @error('full_bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Images</h2>
                    <div class="flex items-start gap-4 mb-4">
                        <img src="{{ $profilePreview }}" alt="" class="h-16 w-16 rounded-full object-cover bg-gray-100 shrink-0">
                        <p class="text-sm text-gray-600">Replace by uploading a new file or pasting a new HTTPS URL below. Leave both empty to keep the current image.</p>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="profile_image_file" class="block text-sm font-medium text-gray-700">Profile image (upload)</label>
                            <input type="file" name="profile_image_file" id="profile_image_file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('profile_image_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="profile_image_url" class="block text-sm font-medium text-gray-700">Profile image (URL)</label>
                            <input type="url" name="profile_image_url" id="profile_image_url" value="{{ $profileUrlOld }}" placeholder="https://…"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('profile_image_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        @if($coverPreview)
                            <div class="rounded-lg overflow-hidden border border-gray-200 max-h-32">
                                <img src="{{ $coverPreview }}" alt="" class="w-full h-24 object-cover">
                            </div>
                        @endif
                        <div>
                            <label for="cover_image_file" class="block text-sm font-medium text-gray-700">Cover image (upload)</label>
                            <input type="file" name="cover_image_file" id="cover_image_file" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('cover_image_file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="cover_image_url" class="block text-sm font-medium text-gray-700">Cover image (URL)</label>
                            <input type="url" name="cover_image_url" id="cover_image_url" value="{{ $coverUrlOld }}" placeholder="https://…"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('cover_image_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        @if($teamMember->cover_image)
                            <div class="flex items-center">
                                <input type="hidden" name="remove_cover_image" value="0">
                                <input type="checkbox" name="remove_cover_image" id="remove_cover_image" value="1" {{ old('remove_cover_image') ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remove_cover_image" class="ml-2 block text-sm text-gray-700">Remove cover image</label>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Contact &amp; location</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $teamMember->email) }}" placeholder="name@company.com"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $teamMember->phone) }}" placeholder="+880 1XXX-XXXXXX"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $teamMember->location) }}" placeholder="e.g. Dhaka, Bangladesh"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="experience_years" class="block text-sm font-medium text-gray-700">Years of experience</label>
                            <input type="number" name="experience_years" id="experience_years" value="{{ old('experience_years', $teamMember->experience_years) }}" min="0" max="80" placeholder="e.g. 8"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('experience_years') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Skills</h2>
                    <label for="skills_text" class="block text-sm font-medium text-gray-700">Skills (one per line)</label>
                    <textarea name="skills_text" id="skills_text" rows="6" placeholder="Laravel&#10;Tailwind CSS"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">{{ $skillsDefault }}</textarea>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Social links</h2>
                    <div class="space-y-3">
                        <div>
                            <label for="social_linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                            <input type="url" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin', $teamMember->social_links['linkedin'] ?? '') }}" placeholder="https://www.linkedin.com/in/username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_linkedin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="social_github" class="block text-sm font-medium text-gray-700">GitHub</label>
                            <input type="url" name="social_github" id="social_github" value="{{ old('social_github', $teamMember->social_links['github'] ?? '') }}" placeholder="https://github.com/username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_github') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="social_twitter" class="block text-sm font-medium text-gray-700">X (Twitter)</label>
                            <input type="url" name="social_twitter" id="social_twitter" value="{{ old('social_twitter', $teamMember->social_links['twitter'] ?? '') }}" placeholder="https://x.com/username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('social_twitter') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="social_website" class="block text-sm font-medium text-gray-700">Website</label>
                            <input type="url" name="social_website" id="social_website" value="{{ old('social_website', $teamMember->social_links['website'] ?? '') }}" placeholder="https://example.com"
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
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $teamMember->status) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm text-gray-700">Active (visible on website)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $teamMember->is_featured) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured</label>
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort order</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $teamMember->sort_order) }}" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex flex-col space-y-3">
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.team-members.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
