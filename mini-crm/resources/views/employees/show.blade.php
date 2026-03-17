{{-- resources/views/employees/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">{{ $employee->full_name }}</h2>
            <a href="{{ route('employees.edit', $employee) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm font-medium">
                Edit Employee
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white shadow rounded-lg p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">First Name</dt>
                    <dd class="mt-1 text-gray-900">{{ $employee->first_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                    <dd class="mt-1 text-gray-900">{{ $employee->last_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Company</dt>
                    <dd class="mt-1 text-gray-900">
                        @if ($employee->company)
                            <a href="{{ route('companies.show', $employee->company) }}" class="text-blue-600 hover:underline">
                                {{ $employee->company->name }}
                            </a>
                        @else
                            —
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-gray-900">{{ $employee->email ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-gray-900">{{ $employee->phone ?? '—' }}</dd>
                </div>
            </dl>
        </div>

        <div>
            <a href="{{ route('employees.index') }}" class="text-sm text-gray-500 hover:underline">← Back to Employees</a>
        </div>

    </div>
</x-app-layout>
