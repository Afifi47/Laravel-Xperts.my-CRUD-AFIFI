{{-- resources/views/employees/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Create Employee</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    {{-- First Name --}}
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="first_name" id="first_name"
                               value="{{ old('first_name') }}"
                               class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('first_name') border-red-500 @enderror"
                               required>
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="last_name" id="last_name"
                               value="{{ old('last_name') }}"
                               class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('last_name') border-red-500 @enderror"
                               required>
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Company --}}
                    <div class="mb-4">
                        <label for="company_id" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                        <select name="company_id" id="company_id"
                                class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Company --</option>
                            @foreach ($companies as $id => $name)
                                <option value="{{ $id }}" {{ old('company_id', request('company_id')) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}"
                               class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="phone"
                               value="{{ old('phone') }}"
                               class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('employees.index') }}"
                           class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                            Create Employee
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
