{{-- resources/views/companies/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Create Company</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                {{--
                    enctype="multipart/form-data" is REQUIRED for file uploads.
                    Without it, the logo file will NOT be sent to the server.
                --}}
                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- CSRF token prevents cross-site request forgery --}}

                    {{-- Name --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name') }}"
                               class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
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

                    {{-- Website --}}
                    <div class="mb-4">
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" name="website" id="website"
                               value="{{ old('website') }}"
                               placeholder="https://example.com"
                               class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('website') border-red-500 @enderror">
                        @error('website')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo Upload --}}
                    <div class="mb-6">
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">
                            Company Logo <span class="text-gray-400 text-xs">(min 100×100px, max 2MB)</span>
                        </label>
                        <input type="file" name="logo" id="logo" accept="image/*"
                               class="w-full text-sm text-gray-500 @error('logo') border border-red-500 rounded @enderror">
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('companies.index') }}"
                           class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                            Create Company
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
