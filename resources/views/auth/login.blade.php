<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Welcome back</h2>
        <p class="theme-text-secondary text-sm mt-2">Sign in to access your Appkotha dashboard.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 dark:bg-neutral-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-400" name="remember">
                <span class="ms-2 text-sm theme-text-secondary">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm theme-text-secondary hover:theme-text-primary" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full saas-btn-primary px-4 py-3 text-sm font-semibold">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    <div class="mt-6">
        <p class="text-xs uppercase tracking-wider theme-text-secondary mb-3">Social login (coming soon)</p>
        <div class="grid grid-cols-2 gap-3">
            <button type="button" disabled class="saas-btn-secondary px-3 py-2 text-xs font-semibold opacity-70 cursor-not-allowed">Google</button>
            <button type="button" disabled class="saas-btn-secondary px-3 py-2 text-xs font-semibold opacity-70 cursor-not-allowed">GitHub</button>
        </div>
    </div>

    <p class="mt-6 text-sm theme-text-secondary">
        New here?
        <a href="{{ route('register') }}" class="theme-text-primary font-semibold hover:underline">Create account</a>
    </p>
</x-guest-layout>
