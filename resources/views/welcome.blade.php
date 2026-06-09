<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PustakaKita &middot; Sistem Manajemen Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased bg-slate-100 text-slate-800">
<div class="min-h-full">
    <header class="mx-auto max-w-7xl px-6 py-5 flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-brand-700 text-xl font-bold">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-600 text-white text-xl">📚</span>
            PustakaKita
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-brand-700 hover:bg-brand-50">Masuk</a>
            <a href="{{ route('register') }}" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 transition">Daftar</a>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6">
        <section class="grid lg:grid-cols-2 gap-10 items-center py-16">
            <div>
                <span class="inline-block rounded-full bg-brand-100 px-3 py-1 text-xs font-semibold text-brand-700">Sistem Manajemen Perpustakaan</span>
                <h1 class="mt-5 text-4xl sm:text-5xl font-extrabold leading-tight text-slate-900">
                    Kelola buku &amp; peminjaman <span class="text-brand-600">dalam satu tempat.</span>
                </h1>
                <p class="mt-5 text-lg text-slate-600 max-w-xl">
                    Pencatatan koleksi, kategori, dan transaksi peminjaman yang rapi dan modern — dilengkapi peran admin &amp; anggota.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white hover:bg-brand-700 transition">Mulai Sekarang</a>
                    <a href="{{ route('login') }}" class="rounded-lg border border-slate-300 bg-white px-6 py-3 font-semibold text-slate-700 hover:bg-slate-50 transition">Masuk ke Akun</a>
                </div>
            </div>
            <div class="relative">
                <div class="rounded-2xl bg-brand-700 p-8 text-white shadow-2xl">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-xl bg-white/10 p-5"><p class="text-3xl">📖</p><p class="mt-2 text-sm text-brand-100">Manajemen Buku</p></div>
                        <div class="rounded-xl bg-white/10 p-5"><p class="text-3xl">🟢</p><p class="mt-2 text-sm text-brand-100">Stok Real-time</p></div>
                        <div class="rounded-xl bg-white/10 p-5"><p class="text-3xl">🔄</p><p class="mt-2 text-sm text-brand-100">Peminjaman</p></div>
                        <div class="rounded-xl bg-white/10 p-5"><p class="text-3xl">👥</p><p class="mt-2 text-sm text-brand-100">Role Admin &amp; Anggota</p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
