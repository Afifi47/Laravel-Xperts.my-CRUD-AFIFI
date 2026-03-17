<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mini CRM') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="min-h-screen lg:flex">
        @include('layouts.navigation')

        <div class="flex min-h-screen min-w-0 flex-1 flex-col">
            <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
                <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-6 sm:px-6 lg:px-8">
                    <div class="min-w-0 flex-1">
                        @isset($header)
                            {{ $header }}
                        @else
                            <div>
                                <h1 class="text-xl font-bold text-slate-900">Mini CRM</h1>
                                <p class="mt-1 text-sm text-slate-500">Manage companies and employees from one place.</p>
                            </div>
                        @endisset
                    </div>

                    <div class="hidden shrink-0 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-right md:block">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400">Today</p>
                        <p class="mt-1 text-sm font-medium text-slate-600">{{ now()->format('l, d M Y') }}</p>
                    </div>
                </div>
            </header>

            <main class="flex-1">
                <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
