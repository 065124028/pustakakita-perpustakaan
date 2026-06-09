<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Masuk') &middot; PustakaKita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased bg-slate-100">
<div class="min-h-full grid lg:grid-cols-2">
    <div class="hidden lg:flex flex-col justify-between bg-brand-700 text-white p-12">
        <a href="{{ url('/') }}" class="flex items-center gap-3 text-xl font-semibold">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 text-2xl">📚</span>
            PustakaKita
        </a>
        <div>
            <h2 class="text-3xl font-bold leading-snug">Kelola koleksi perpustakaan dengan mudah.</h2>
            <p class="mt-4 text-brand-100 max-w-md">Pencatatan buku, kategori, dan peminjaman dalam satu tempat. Cepat, rapi, dan modern.</p>
        </div>
        <p class="text-sm text-brand-200">Sistem Manajemen Perpustakaan &copy; {{ date('Y') }}</p>
    </div>

    <div class="flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md">
            <div class="lg:hidden mb-8 flex items-center gap-2 text-brand-700 text-xl font-semibold">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-600 text-white text-xl">📚</span>
                PustakaKita
            </div>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
