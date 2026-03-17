{{-- resources/views/employees/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Employees</h2>
            <a href="{{ route('employees.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-medium">
                + Add Employee
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($employees as $employee)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $employee->full_name }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if ($employee->company)
                                        <a href="{{ route('companies.show', $employee->company) }}"
                                           class="text-indigo-600 hover:underline">
                                            {{ $employee->company->name }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $employee->email ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $employee->phone ?? '—' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('employees.edit', $employee) }}"
                                       class="px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Delete {{ addslashes($employee->full_name) }}?')">
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
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    No employees found. <a href="{{ route('employees.create') }}" class="text-indigo-600 hover:underline">Add one now.</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($employees->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $employees->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
