<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $query = Setting::query();

        if ($request->filled('search')) {
            $query->where('key', 'like', '%' . $request->search . '%')
                  ->orWhere('label', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }

        $settings = $query->orderBy('group')->orderBy('sort_order')->paginate(20);
        $groups = Setting::getGroups();
        $types = Setting::getTypes();

        return view('admin.settings.index', compact('settings', 'groups', 'types'));
    }

    public function create()
    {
        $groups = Setting::getGroups();
        $types = Setting::getTypes();
        return view('admin.settings.create', compact('groups', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group' => 'required|string|max:100',
            'key' => 'required|string|max:255|alpha_dash',
            'label' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'value' => 'nullable',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
        ]);

        // Check for duplicate group+key combination
        if (Setting::where('group', $validated['group'])->where('key', $validated['key'])->exists()) {
            return back()->withInput()->with('error', 'A setting with this group and key already exists.');
        }

        // Handle image upload
        if ($validated['type'] === 'image' && $request->hasFile('value')) {
            $validated['value'] = $request->file('value')->store('settings', 'public');
        }

        // Handle boolean type
        if ($validated['type'] === 'boolean') {
            $validated['value'] = $request->boolean('value') ? '1' : '0';
        }

        Setting::create($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully.');
    }

    public function edit(Setting $setting)
    {
        $groups = Setting::getGroups();
        $types = Setting::getTypes();
        return view('admin.settings.edit', compact('setting', 'groups', 'types'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'group' => 'required|string|max:100',
            'key' => 'required|string|max:255|alpha_dash',
            'label' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'value' => 'nullable',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
        ]);

        // Check for duplicate group+key combination (excluding current)
        if (Setting::where('group', $validated['group'])
            ->where('key', $validated['key'])
            ->where('id', '!=', $setting->id)
            ->exists()) {
            return back()->withInput()->with('error', 'A setting with this group and key already exists.');
        }

        // Handle image upload
        if ($validated['type'] === 'image' && $request->hasFile('value')) {
            // Delete old image if exists
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
            $validated['value'] = $request->file('value')->store('settings', 'public');
        } elseif ($validated['type'] === 'image' && !$request->hasFile('value')) {
            // Keep existing value if no new image uploaded
            $validated['value'] = $setting->value;
        }

        // Handle boolean type
        if ($validated['type'] === 'boolean') {
            $validated['value'] = $request->boolean('value') ? '1' : '0';
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    public function destroy(Setting $setting)
    {
        // Delete associated image if exists
        if ($setting->type === 'image' && $setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }

        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }

    /**
     * Display grouped settings page for easier editing
     */
    public function grouped()
    {
        $groups = Setting::getGroups();
        $settingsByGroup = [];

        foreach ($groups as $key => $label) {
            $settingsByGroup[$key] = [
                'label' => $label,
                'settings' => Setting::where('group', $key)->orderBy('sort_order')->get()
            ];
        }

        return view('admin.settings.grouped', compact('settingsByGroup', 'groups'));
    }

    /**
     * Update multiple settings at once (from grouped page)
     */
    public function updateGrouped(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $id => $value) {
            $setting = Setting::find($id);
            if ($setting) {
                // Handle file uploads
                if ($setting->type === 'image' && $request->hasFile("settings.{$id}")) {
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $value = $request->file("settings.{$id}")->store('settings', 'public');
                }

                // Handle boolean type
                if ($setting->type === 'boolean') {
                    $value = $value ? '1' : '0';
                }

                $setting->update(['value' => $value]);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
