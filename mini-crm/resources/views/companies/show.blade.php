{{-- resources/views/companies/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('companies.index') }}" class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $company->name }}</h2>
                <p class="text-sm text-gray-500">Company details and employees</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex items-start gap-6">
                @if ($company->logo_url)
                    <img src="{{ $company->logo_url }}" alt="{{ $company->name }}"
                         class="h-20 w-20 rounded-2xl border border-gray-200 object-cover shadow-sm">
                @else
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-100 to-indigo-100">
                        <span class="text-2xl font-bold text-blue-600">{{ strtoupper(substr($company->name, 0, 2)) }}</span>
                    </div>
                @endif

                <div class="flex-1">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $company->name }}</h3>
                            @if ($company->email)
                                <p class="mt-1 flex items-center gap-1 text-sm text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $company->email }}
                                </p>
                            @endif
                            @if ($company->website)
                                <p class="mt-1 flex items-center gap-1 text-sm">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                    <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">{{ $company->website }}</a>
                                </p>
                            @endif
                        </div>

                        <a href="{{ route('companies.edit', $company) }}"
                           class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                    </div>

                    <p class="mt-3 text-xs text-gray-400">Created {{ $company->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-semibold text-gray-800">Employees</h3>
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">
                        {{ $company->employees_count }}
                    </span>
                </div>

                <a href="{{ route('employees.create') }}?company_id={{ $company->id }}"
                   class="inline-flex items-center gap-1.5 rounded-lg border border-blue-200 px-3 py-1.5 text-sm font-medium text-blue-600 transition-colors hover:bg-blue-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Employee
                </a>
            </div>

            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($company->employees as $employee)
                        <tr class="transition-colors duration-150 hover:bg-blue-50/30">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 text-xs font-bold text-white">
                                        {{ strtoupper(substr($employee->first_name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $employee->full_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $employee->email ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $employee->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="inline-block rounded-lg p-2 text-gray-400 transition-colors hover:bg-blue-50 hover:text-blue-600" title="Edit">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">No employees yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
