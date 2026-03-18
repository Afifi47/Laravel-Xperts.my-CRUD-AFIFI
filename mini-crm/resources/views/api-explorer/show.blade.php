<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 shadow-lg shadow-indigo-500/20">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l-3 3 3 3m8-6l3 3-3 3M13 7l-2 10" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900">API Explorer</h2>
                <p class="text-sm text-slate-500">Preview the company API response from inside the admin panel</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-4 xl:grid-cols-[minmax(0,1.3fr)_minmax(0,0.7fr)]">
            <div class="rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-indigo-950 p-6 text-white shadow-xl shadow-slate-900/10">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-200/80">Developer View</p>
                <h3 class="mt-3 text-2xl font-bold">Inspect a real company payload</h3>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                    This page uses the same <code class="rounded bg-white/10 px-1.5 py-0.5 text-cyan-100">CompanyResource</code>
                    as the public API, so the JSON below matches what your frontend or Postman request will receive.
                </p>

                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ $rawUrl }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-cyan-50">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7m0-7L10 14m-4 1H4a1 1 0 01-1-1v-2m16 4v4a1 1 0 01-1 1h-4M5 10V6a1 1 0 011-1h4" />
                        </svg>
                        Open Raw JSON
                    </a>

                    <a href="{{ $listUrl }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 rounded-2xl border border-white/15 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Open Companies Index
                    </a>

                    @if ($selectedCompany)
                        <a href="{{ route('companies.show', $selectedCompany) }}"
                           class="inline-flex items-center gap-2 rounded-2xl border border-white/15 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to Company
                        </a>
                    @endif
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <form method="GET" action="{{ route('api-explorer.show') }}" class="space-y-4">
                    <div>
                        <label for="company" class="text-sm font-semibold text-slate-700">Choose company</label>
                        <select id="company" name="company"
                                class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
                                onchange="this.form.submit()">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @selected(optional($selectedCompany)->id === $company->id)>
                                    {{ $company->name }} ({{ $company->employees_count }} employees)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 text-sm font-semibold text-white transition hover:from-indigo-700 hover:to-cyan-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Refresh Response
                    </button>
                </form>

                @if ($selectedCompany)
                    <div class="mt-6 space-y-4">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Selected</p>
                            <p class="mt-2 text-lg font-bold text-slate-900">{{ $selectedCompany->name }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $selectedCompany->email ?: 'No email address' }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Employees</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900">{{ $selectedCompany->employees_count }}</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Endpoint</p>
                                <p class="mt-2 break-all text-sm font-medium text-indigo-600">{{ $rawUrl }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-6 rounded-2xl border border-dashed border-slate-200 bg-slate-50 px-4 py-10 text-center text-sm text-slate-500">
                        Create a company first to preview the API response.
                    </div>
                @endif
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                <div>
                    <h3 class="font-semibold text-slate-800">JSON Response</h3>
                    <p class="mt-1 text-sm text-slate-500">Server-rendered preview of the selected company endpoint.</p>
                </div>

                @if ($selectedCompany)
                    <a href="{{ $rawUrl }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7v7m0-7L10 14m-4 1H4a1 1 0 01-1-1v-2m16 4v4a1 1 0 01-1 1h-4M5 10V6a1 1 0 011-1h4" />
                        </svg>
                        Open Raw
                    </a>
                @endif
            </div>

            <div class="bg-slate-950">
                <pre class="overflow-x-auto p-6 text-sm leading-7 text-slate-200"><code>{{ $payload ?? "{\n    \"message\": \"No companies available yet.\"\n}" }}</code></pre>
            </div>
        </div>
    </div>
</x-app-layout>
