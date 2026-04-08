<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Create your account</h2>
        <p class="theme-text-secondary text-sm mt-2">Register as an Appkotha customer to access your support and personalized workspace.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full rounded-xl" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full rounded-xl" type="text" name="phone" :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full rounded-xl"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <label for="terms" class="inline-flex items-start gap-2 text-sm theme-text-secondary">
                <input id="terms" name="terms" type="checkbox" value="1" class="mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-neutral-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-400" {{ old('terms') ? 'checked' : '' }}>
                <span>I agree to the terms and privacy policy.</span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <div>
            <button type="submit" class="w-full saas-btn-primary px-4 py-3 text-sm font-semibold">
                {{ __('Create account') }}
            </button>
        </div>
    </form>

    <p class="mt-6 text-sm theme-text-secondary">
        Already registered?
        <a href="{{ route('login') }}" class="theme-text-primary font-semibold hover:underline">Sign in</a>
    </p>
</x-guest-layout>
