<x-admin-layout>
    <x-slot name="title">Case Studies</x-slot>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Case Studies</h1>
            <p class="mt-1 text-sm text-gray-500">Showcase your project successes</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.case-studies.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Case Study
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow-sm rounded-lg p-4 mb-6">
        <form action="{{ route('admin.case-studies.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search case studies..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            </div>
            <div class="w-full sm:w-40">
                <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-medium text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200">Filter</button>
        </form>
    </div>

    <!-- Case Studies Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($caseStudies as $caseStudy)
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                @if($caseStudy->featured_image)
                    <img class="h-40 w-full object-cover" src="{{ Storage::url($caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}">
                @else
                    <div class="h-40 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">{{ substr($caseStudy->client_name, 0, 1) }}</span>
                    </div>
                @endif
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">{{ Str::limit($caseStudy->title, 40) }}</h3>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $caseStudy->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $caseStudy->is_published ? 'Live' : 'Draft' }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mb-2">{{ $caseStudy->client_name }}</p>
                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($caseStudy->excerpt, 80) }}</p>

                    @if($caseStudy->tech_stack)
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(array_slice($caseStudy->tech_stack, 0, 3) as $tech)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">{{ $tech }}</span>
                            @endforeach
                            @if(count($caseStudy->tech_stack) > 3)
                                <span class="text-xs text-gray-500">+{{ count($caseStudy->tech_stack) - 3 }} more</span>
                            @endif
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xs text-gray-500">{{ $caseStudy->project_duration }}</span>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.case-studies.edit', $caseStudy) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                            <form action="{{ route('admin.case-studies.destroy', $caseStudy) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete this case study?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3">
                <div class="bg-white shadow-sm rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No case studies</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new case study.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.case-studies.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            New Case Study
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if($caseStudies->hasPages())
        <div class="mt-6">{{ $caseStudies->links() }}</div>
    @endif
</x-admin-layout>
