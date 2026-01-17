<x-admin-layout>
    <x-slot name="title">Site Settings</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Site Settings</h1>
            <p class="mt-1 text-sm text-gray-500">Edit all site settings organized by group</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <a href="{{ route('admin.settings.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                List View
            </a>
            <a href="{{ route('admin.settings.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Setting
            </a>
        </div>
    </div>

    <form action="{{ route('admin.settings.update-grouped') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
            @foreach($settingsByGroup as $groupKey => $group)
                @if($group['settings']->count() > 0)
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">{{ $group['label'] }}</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($group['settings'] as $setting)
                                    <div class="@if(in_array($setting->type, ['textarea', 'richtext', 'json'])) md:col-span-2 @endif">
                                        <label for="setting_{{ $setting->id }}" class="block text-sm font-medium text-gray-700">
                                            {{ $setting->label ?? $setting->key }}
                                        </label>

                                        @if($setting->description)
                                            <p class="mt-1 text-xs text-gray-500">{{ $setting->description }}</p>
                                        @endif

                                        @switch($setting->type)
                                            @case('text')
                                            @case('url')
                                            @case('number')
                                                <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}"
                                                    name="settings[{{ $setting->id }}]"
                                                    id="setting_{{ $setting->id }}"
                                                    value="{{ $setting->value }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                                @break

                                            @case('textarea')
                                            @case('richtext')
                                                <textarea name="settings[{{ $setting->id }}]"
                                                    id="setting_{{ $setting->id }}"
                                                    rows="3"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">{{ $setting->value }}</textarea>
                                                @break

                                            @case('color')
                                                <div class="mt-1 flex items-center space-x-3">
                                                    <input type="color"
                                                        name="settings[{{ $setting->id }}]"
                                                        id="setting_{{ $setting->id }}"
                                                        value="{{ $setting->value ?: '#000000' }}"
                                                        class="h-10 w-16 rounded border-gray-300 cursor-pointer">
                                                    <span class="text-sm text-gray-500 font-mono">{{ $setting->value }}</span>
                                                </div>
                                                @break

                                            @case('boolean')
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox"
                                                            name="settings[{{ $setting->id }}]"
                                                            id="setting_{{ $setting->id }}"
                                                            value="1"
                                                            {{ filter_var($setting->value, FILTER_VALIDATE_BOOLEAN) ? 'checked' : '' }}
                                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                        <span class="ml-2 text-sm text-gray-700">Enabled</span>
                                                    </label>
                                                </div>
                                                @break

                                            @case('image')
                                                <div class="mt-2 flex items-center space-x-4">
                                                    @if($setting->value)
                                                        <img src="{{ Storage::url($setting->value) }}" alt="" class="h-16 w-auto rounded border border-gray-200">
                                                    @endif
                                                    <input type="file"
                                                        name="settings[{{ $setting->id }}]"
                                                        id="setting_{{ $setting->id }}"
                                                        accept="image/*"
                                                        class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                                </div>
                                                @break

                                            @case('json')
                                                <textarea name="settings[{{ $setting->id }}]"
                                                    id="setting_{{ $setting->id }}"
                                                    rows="4"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono">{{ $setting->value }}</textarea>
                                                @break

                                            @default
                                                <input type="text"
                                                    name="settings[{{ $setting->id }}]"
                                                    id="setting_{{ $setting->id }}"
                                                    value="{{ $setting->value }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Save Button -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save All Settings
            </button>
        </div>
    </form>
</x-admin-layout>
