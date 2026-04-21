<x-layouts.frontend title="Profile & Settings">
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-[260px_minmax(0,1fr)] gap-6">
                @include('user.partials.nav')

                <div class="space-y-6">
                    <div class="saas-card p-6">
                        <h1 class="text-2xl font-bold">Profile Overview</h1>
                        <p class="theme-text-secondary text-sm mt-2">Keep your account information and preferences up to date.</p>
                    </div>

                    <div class="saas-card p-6">
                        <h2 class="text-lg font-semibold mb-4">Basic information</h2>
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="name">Full Name</label>
                                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full rounded-xl" required>
                                    @error('name')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="email">Email</label>
                                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl" required>
                                    @error('email')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="phone">Phone</label>
                                    <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" class="w-full rounded-xl">
                                    @error('phone')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="theme_preference">Theme Preference</label>
                                    <select id="theme_preference" name="theme_preference" class="w-full rounded-xl">
                                        @foreach(['system' => 'System', 'light' => 'Light', 'dark' => 'Dark'] as $value => $label)
                                            <option value="{{ $value }}" @selected(old('theme_preference', $user->theme_preference ?? 'system') === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('theme_preference')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                            <button class="saas-btn-primary px-5 py-2.5 text-sm font-semibold" type="submit">Save profile</button>
                        </form>
                    </div>

                    <div class="saas-card p-6">
                        <h2 class="text-lg font-semibold mb-4">Change password</h2>
                        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-medium mb-2" for="current_password">Current Password</label>
                                <input id="current_password" name="current_password" type="password" class="w-full rounded-xl" required>
                                @error('current_password', 'updatePassword')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="password">New Password</label>
                                    <input id="password" name="password" type="password" class="w-full rounded-xl" required>
                                    @error('password', 'updatePassword')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2" for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-xl" required>
                                </div>
                            </div>
                            <button class="saas-btn-secondary px-5 py-2.5 text-sm font-semibold" type="submit">Update password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
