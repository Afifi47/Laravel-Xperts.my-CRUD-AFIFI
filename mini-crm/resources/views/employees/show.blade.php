{{-- resources/views/employees/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('employees.index', absolute: false) }}" class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $employee->full_name }}</h2>
                <p class="text-sm text-gray-500">Employee details and assigned company.</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 text-lg font-bold text-white">
                        {{ strtoupper(substr($employee->first_name, 0, 1) . substr($employee->last_name, 0, 1)) }}
                    </div>
                </div>

                <div class="flex-1">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $employee->full_name }}</h3>
                            @if ($employee->email)
                                <p class="mt-1 text-sm text-gray-500">{{ $employee->email }}</p>
                            @endif
                            @if ($employee->phone)
                                <p class="mt-1 text-sm text-gray-500">{{ $employee->phone }}</p>
                            @endif
                        </div>

                        <a href="{{ route('employees.edit', $employee, absolute: false) }}"
                           class="inline-flex items-center gap-1.5 rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                    </div>

                    <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">First Name</dt>
                            <dd class="mt-1 text-gray-900">{{ $employee->first_name }}</dd>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                            <dd class="mt-1 text-gray-900">{{ $employee->last_name }}</dd>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">Company</dt>
                            <dd class="mt-1 text-gray-900">
                                @if ($employee->company)
                                    <a href="{{ route('companies.show', $employee->company, absolute: false) }}" class="text-blue-600 hover:underline">
                                        {{ $employee->company->name }}
                                    </a>
                                @else
                                    -
                                @endif
                            </dd>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-gray-900">{{ $employee->email ?? '-' }}</dd>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-4 sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-gray-900">{{ $employee->phone ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div>
            <a href="{{ route('employees.index', absolute: false) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 hover:underline">
                Back to Employees
            </a>
        </div>
    </div>
</x-app-layout>
