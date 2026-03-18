{{-- resources/views/employees/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('employees.index', absolute: false) }}" class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Create Employee</h2>
                <p class="text-sm text-gray-500">Add a new team member to the CRM.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
            <form action="{{ route('employees.store', absolute: false) }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="first_name" class="mb-2 block text-sm font-semibold text-gray-700">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" id="first_name"
                                   value="{{ old('first_name') }}"
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 transition-colors focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 @error('first_name') border-red-400 @enderror"
                                   placeholder="Lucas"
                                   required>
                            @error('first_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="mb-2 block text-sm font-semibold text-gray-700">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" id="last_name"
                                   value="{{ old('last_name') }}"
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 transition-colors focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 @error('last_name') border-red-400 @enderror"
                                   placeholder="Podolski"
                                   required>
                            @error('last_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="company_id" class="mb-2 block text-sm font-semibold text-gray-700">Company</label>
                        <select name="company_id" id="company_id"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 transition-colors focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 @error('company_id') border-red-400 @enderror">
                            <option value="">Select a company</option>
                            @foreach ($companies as $id => $name)
                                <option value="{{ $id }}" {{ old('company_id', request('company_id')) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email') }}"
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 transition-colors focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 @error('email') border-red-400 @enderror"
                                   placeholder="employee@example.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="mb-2 block text-sm font-semibold text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 transition-colors focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 @error('phone') border-red-400 @enderror"
                                   placeholder="0123456789">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                    <a href="{{ route('employees.index', absolute: false) }}"
                       class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                            class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 px-5 py-2.5 text-sm font-medium text-white transition-all hover:from-emerald-600 hover:to-teal-700 hover:shadow-md">
                        Create Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
