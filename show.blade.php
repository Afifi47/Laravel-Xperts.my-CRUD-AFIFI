{{-- resources/views/companies/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">{{ $company->name }}</h2>
            <a href="{{ route('companies.edit', $company) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm font-medium">
                Edit Company
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Company Details Card --}}
        <div class="bg-white shadow rounded-lg p-6 flex gap-6 items-start">
            @if ($company->logo_url)
                <img src="{{ $company->logo_url }}" alt="{{ $company->name }}"
                     class="h-24 w-24 object-cover rounded border">
            @endif
            <div>
                <h3 class="text-lg font-semibold text-gray-900">{{ $company->name }}</h3>
                @if ($company->email)
                    <p class="text-gray-600 text-sm mt-1">✉ {{ $company->email }}</p>
                @endif
                @if ($company->website)
                    <p class="text-gray-600 text-sm mt-1">
                        🌐 <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer"
                              class="text-indigo-600 hover:underline">{{ $company->website }}</a>
                    </p>
                @endif
                <p class="text-gray-400 text-xs mt-2">Created: {{ $company->created_at->format('d M Y') }}</p>
            </div>
        </div>

        {{-- Employees Section --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-semibold text-gray-800">
                    Employees <span class="text-gray-400 font-normal">({{ $company->employees->count() }})</span>
                </h3>
                <a href="{{ route('employees.create') }}?company_id={{ $company->id }}"
                   class="text-sm text-indigo-600 hover:underline">+ Add Employee</a>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($company->employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $employee->full_name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $employee->email ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $employee->phone ?? '—' }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="text-sm text-indigo-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-400">No employees yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            <a href="{{ route('companies.index') }}" class="text-sm text-gray-500 hover:underline">← Back to Companies</a>
        </div>

    </div>
</x-app-layout>
