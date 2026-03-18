@php
    $user = Auth::user();
    $initials = collect(preg_split('/\s+/', trim($user->name)))
        ->filter()
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');

    $navItems = [
        [
            'label' => 'Companies',
            'route' => route('companies.index', absolute: false),
            'active' => 'companies.*',
            'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        ],
        [
            'label' => 'Employees',
            'route' => route('employees.index', absolute: false),
            'active' => 'employees.*',
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        ],
    ];
@endphp

<aside class="border-b border-slate-800 bg-slate-950 text-slate-100 lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
    <div class="flex h-full flex-col">
        <div class="border-b border-slate-800 px-5 py-6">
            <a href="{{ route('companies.index', absolute: false) }}" class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold tracking-tight text-white">Mini CRM</p>
                    <p class="text-sm text-slate-400">Admin Panel</p>
                </div>
            </a>
        </div>

        <div class="flex-1 px-4 py-6">
            <p class="px-3 text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Management</p>
            <div class="mt-4 space-y-1">
                @foreach ($navItems as $item)
                    @php($isActive = request()->routeIs($item['active']))
                    <a href="{{ $item['route'] }}"
                       class="{{ $isActive ? 'bg-blue-600/20 text-blue-200 shadow-[inset_0_0_0_1px_rgba(96,165,250,0.2)]' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} group flex items-center justify-between rounded-2xl px-3 py-3 text-sm font-semibold transition">
                        <span class="flex items-center gap-3">
                            <svg class="h-5 w-5 {{ $isActive ? 'text-blue-300' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                            </svg>
                            {{ $item['label'] }}
                        </span>

                        @if ($isActive)
                            <span class="h-2.5 w-2.5 rounded-full bg-blue-400"></span>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="mt-8 rounded-3xl border border-slate-800 bg-slate-900/80 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">Account</p>
                <a href="{{ route('profile.edit', absolute: false) }}"
                   class="mt-3 flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11.969 11.969 0 0112 15c2.5 0 4.823.767 6.879 2.078M15 11a3 3 0 11-6 0 3 3 0 016 0zm6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Profile Settings
                </a>
            </div>
        </div>

        <div class="border-t border-slate-800 px-5 py-5">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-400/20 text-sm font-bold text-emerald-300">
                    {{ $initials }}
                </div>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-white">{{ $user->name }}</p>
                    <p class="truncate text-sm text-slate-400">{{ $user->email }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout', absolute: false) }}" class="mt-4">
                @csrf
                <button type="submit"
                        class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-slate-900 hover:text-white">
                    <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </div>
</aside>
