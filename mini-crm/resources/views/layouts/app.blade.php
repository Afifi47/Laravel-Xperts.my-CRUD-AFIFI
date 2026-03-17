<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mini CRM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-50">

            {{-- Sidebar --}}
            <aside class="hidden md:flex md:flex-col w-64 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white shadow-xl fixed h-full z-30">
                {{-- Logo / Brand --}}
                <div class="px-6 py-5 border-b border-slate-700/50">
                    <a href="{{ route('companies.index') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold tracking-tight">Mini CRM</h1>
                            <p class="text-xs text-slate-400">Admin Panel</p>
                        </div>
                    </a>
                </div>

                {{-- Navigation --}}
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <p class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Management</p>

                    {{-- Companies Link --}}
                    <a href="{{ route('companies.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                              {{ request()->routeIs('companies.*') ? 'bg-blue-600/20 text-blue-400 shadow-sm' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('companies.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Companies
                        @if(request()->routeIs('companies.*'))
                            <span class="ml-auto w-1.5 h-1.5 bg-blue-400 rounded-full"></span>
                        @endif
                    </a>

                    {{-- Employees Link --}}
                    <a href="{{ route('employees.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                              {{ request()->routeIs('employees.*') ? 'bg-blue-600/20 text-blue-400 shadow-sm' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('employees.*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Employees
                        @if(request()->routeIs('employees.*'))
                            <span class="ml-auto w-1.5 h-1.5 bg-blue-400 rounded-full"></span>
                        @endif
                    </a>
                </nav>

                {{-- User Section at Bottom --}}
                <div class="px-4 py-4 border-t border-slate-700/50">
                    <div class="flex items-center gap-3 px-3 py-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-sm font-bold text-white shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-2 px-3 py-2 text-sm text-slate-400 rounded-lg hover:bg-red-500/10 hover:text-red-400 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 md:ml-64">
                {{-- Top Header Bar --}}
                <header class="bg-white/80 backdrop-blur-md border-b border-gray-200/60 sticky top-0 z-20">
                    <div class="px-6 py-4 flex items-center justify-between">
                        @isset($header)
                            {{ $header }}
                        @endisset

                        <div class="flex items-center gap-3">
                            <span class="hidden sm:inline text-sm text-gray-500">
                                {{ now()->format('l, d M Y') }}
                            </span>
                        </div>
                    </div>
                </header>

                {{-- Page Content --}}
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
