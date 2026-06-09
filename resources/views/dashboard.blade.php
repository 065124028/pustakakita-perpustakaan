@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('subheader', 'Ringkasan aktivitas perpustakaan')

@section('content')
    @php($u = auth()->user())

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @if ($u->isAdmin())
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Total Buku</p>
                <p class="mt-1 text-3xl font-bold text-brand-700">{{ $stats['books'] }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Kategori</p>
                <p class="mt-1 text-3xl font-bold text-brand-700">{{ $stats['categories'] }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Anggota</p>
                <p class="mt-1 text-3xl font-bold text-brand-700">{{ $stats['members'] }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Sedang Dipinjam</p>
                <p class="mt-1 text-3xl font-bold text-amber-600">{{ $stats['active_loans'] }}</p>
            </div>
        @else
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Pinjaman Aktif</p>
                <p class="mt-1 text-3xl font-bold text-amber-600">{{ $stats['my_active'] }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Total Pinjaman Saya</p>
                <p class="mt-1 text-3xl font-bold text-brand-700">{{ $stats['my_total'] }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Buku Tersedia</p>
                <p class="mt-1 text-3xl font-bold text-brand-700">{{ $stats['books'] }}</p>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-sm border border-slate-200">
                <p class="text-sm text-slate-500">Kategori</p>
                <p class="mt-1 text-3xl font-bold text-brand-700">{{ $stats['categories'] }}</p>
            </div>
        @endif
    </div>

    <div class="mt-8 rounded-xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">{{ $u->isAdmin() ? 'Peminjaman Terbaru' : 'Pinjaman Saya Terbaru' }}</h2>
            <a href="{{ route('loans.index') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700">Lihat semua</a>
        </div>
        @if ($recentLoans->isEmpty())
            <p class="px-5 py-8 text-center text-sm text-slate-400">Belum ada data peminjaman.</p>
        @else
            <div class="divide-y divide-slate-100">
                @foreach ($recentLoans as $loan)
                    <div class="px-5 py-3 flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <p class="font-medium text-slate-800 truncate">{{ $loan->book->title ?? '-' }}</p>
                            <p class="text-xs text-slate-500">
                                @if ($u->isAdmin())
                                    oleh {{ $loan->user->name ?? '-' }} &middot;
                                @endif
                                {{ $loan->borrowed_at?->format('d M Y') }}
                            </p>
                        </div>
                        @if ($loan->status === 'dipinjam')
                            <span class="shrink-0 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-700">Dipinjam</span>
                        @else
                            <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Dikembalikan</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
