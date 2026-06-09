<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') &middot; PustakaKita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-100 text-slate-800 font-sans antialiased">
@php($u = auth()->user())
@php($active = fn ($pattern) => request()->routeIs($pattern) ? 'bg-white/15 text-white' : 'text-brand-100 hover:bg-white/10 hover:text-white')
<div class="min-h-full">
    <nav class="bg-brand-700 text-white shadow-lg sticky top-0 z-30">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-semibold text-lg">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15 text-xl">📚</span>
                        <span>PustakaKita</span>
                    </a>
                    <div class="hidden md:flex items-center gap-1">
                        <a href="{{ route('dashboard') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $active('dashboard') }}">Dashboard</a>
                        <a href="{{ route('books.index') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $active('books.*') }}">Buku</a>
                        <a href="{{ route('loans.index') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $active('loans.*') }}">Peminjaman</a>
                        @if ($u?->isAdmin())
                            <a href="{{ route('categories.index') }}" class="rounded-md px-3 py-2 text-sm font-medium {{ $active('categories.*') }}">Kategori</a>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col text-right leading-tight">
                        <span class="text-sm font-medium">{{ $u?->name }}</span>
                        <span class="text-xs text-brand-200 capitalize">{{ $u?->role }}</span>
                    </div>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-brand-700 font-semibold">{{ strtoupper(substr($u?->name ?? 'U', 0, 1)) }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md bg-white/10 px-3 py-2 text-sm font-medium text-white hover:bg-white/20 transition">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="md:hidden border-t border-white/10 px-2 py-2 flex gap-1 overflow-x-auto">
            <a href="{{ route('dashboard') }}" class="whitespace-nowrap rounded-md px-3 py-1.5 text-sm {{ $active('dashboard') }}">Dashboard</a>
            <a href="{{ route('books.index') }}" class="whitespace-nowrap rounded-md px-3 py-1.5 text-sm {{ $active('books.*') }}">Buku</a>
            <a href="{{ route('loans.index') }}" class="whitespace-nowrap rounded-md px-3 py-1.5 text-sm {{ $active('loans.*') }}">Peminjaman</a>
            @if ($u?->isAdmin())
                <a href="{{ route('categories.index') }}" class="whitespace-nowrap rounded-md px-3 py-1.5 text-sm {{ $active('categories.*') }}">Kategori</a>
            @endif
        </div>
    </nav>

    <header class="bg-white border-b border-slate-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">@yield('header', 'Dashboard')</h1>
                @hasSection('subheader')
                    <p class="text-sm text-slate-500 mt-1">@yield('subheader')</p>
                @endif
            </div>
            <div>@yield('actions')</div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 text-center text-xs text-slate-400">
        PustakaKita &mdash; Sistem Manajemen Perpustakaan &copy; {{ date('Y') }}
    </footer>
</div>
</body>
</html>
