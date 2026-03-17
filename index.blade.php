{{-- resources/views/companies/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Companies</h2>
            <a href="{{ route('companies.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-medium">
                + Create New Company
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash success message --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Website</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employees</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($companies as $company)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    @if ($company->logo_url)
                                        <img src="{{ $company->logo_url }}"
                                             alt="{{ $company->name }} logo"
                                             class="h-10 w-10 object-cover rounded">
                                    @else
                                        <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">
                                            N/A
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <a href="{{ route('companies.show', $company) }}" class="hover:underline text-indigo-600">
                                        {{ $company->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $company->email ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if ($company->website)
                                        <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer"
                                           class="text-indigo-600 hover:underline">
                                            {{ $company->website }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $company->employees_count ?? $company->employees()->count() }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('companies.edit', $company) }}"
                                       class="px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200">
                                        Edit
                                    </a>
                                    {{-- Delete uses a form with POST + method spoofing for DELETE --}}
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Delete {{ addslashes($company->name) }}? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-sm bg-red-100 text-red-800 rounded hover:bg-red-200">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    No companies found. <a href="{{ route('companies.create') }}" class="text-indigo-600 hover:underline">Create one now.</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination links --}}
                @if ($companies->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $companies->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
