{{-- resources/views/companies/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('companies.index') }}" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Edit Company</h2>
                <p class="text-sm text-gray-500">Update {{ $company->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $company->name) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors @error('name') border-red-400 @enderror"
                               required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email', $company->email) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div>
                        <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">Website</label>
                        <input type="url" name="website" id="website"
                               value="{{ old('website', $company->website) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-colors @error('website') border-red-400 @enderror"
                               placeholder="https://example.com">
                        @error('website')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div>
                        <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">
                            Company Logo <span class="text-gray-400 text-xs font-normal">(leave blank to keep existing)</span>
                        </label>
                        @if ($company->logo_url)
                            <div class="mb-3 flex items-center gap-3">
                                <img src="{{ $company->logo_url }}" alt="Current logo"
                                     class="w-16 h-16 rounded-xl object-cover border border-gray-200 shadow-sm">
                                <span class="text-sm text-gray-500">Current logo</span>
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="logo" id="logo" accept="image/*" class="w-full text-sm text-gray-500">
                            <p class="mt-2 text-xs text-gray-400">JPG, PNG or GIF — min 100×100px, max 2MB</p>
                        </div>
                        @error('logo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('companies.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-sm hover:shadow-md transition-all">
                        Update Company
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
