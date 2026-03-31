<x-admin-layout>
    <x-slot name="title">Team Members</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Team Members</h1>
            <p class="mt-1 text-sm text-gray-500">Manage people shown on the public <a href="{{ route('team.index') }}" class="text-indigo-600 hover:underline" target="_blank" rel="noopener">/team</a> page</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.team-members.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add member
            </a>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4 mb-6">
        <form action="{{ route('admin.team-members.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, role, email, or slug…"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            </div>
            <div class="w-full sm:w-44">
                <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="">All statuses</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active (visible)</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive (hidden)</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-medium text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">Filter</button>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Slug</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Sort</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($teamMembers as $member)
                        @php
                            $img = \Illuminate\Support\Str::startsWith($member->profile_image, ['http://', 'https://'])
                                ? $member->profile_image
                                : \Illuminate\Support\Facades\Storage::url($member->profile_image);
                        @endphp
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $img }}" alt="" class="h-10 w-10 rounded-full object-cover bg-gray-100 shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $member->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $member->designation }}</p>
                                        @if($member->is_featured)
                                            <span class="mt-0.5 inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-amber-100 text-amber-800">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600 hidden md:table-cell">
                                <code class="text-xs bg-gray-100 px-1.5 py-0.5 rounded">{{ $member->slug }}</code>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600 hidden lg:table-cell">{{ $member->sort_order }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <form action="{{ route('admin.team-members.toggle-status', $member) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $member->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $member->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm space-x-3">
                                <a href="{{ route('team.show', $member->slug) }}" target="_blank" rel="noopener" class="text-gray-600 hover:text-gray-900">View</a>
                                <a href="{{ route('admin.team-members.edit', $member) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="inline" onsubmit="return confirm('Delete this team member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-sm text-gray-500">No team members yet. Click “Add member” to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($teamMembers->hasPages())
            <div class="px-4 py-3 border-t border-gray-200">{{ $teamMembers->links() }}</div>
        @endif
    </div>
</x-admin-layout>
