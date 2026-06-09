@extends('layouts.app')

@section('title', $book->title)
@section('header', 'Detail Buku')

@section('actions')
    <a href="{{ route('books.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">&larr; Kembali</a>
@endsection

@section('content')
    <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <div class="aspect-[3/4] rounded-xl bg-slate-100 overflow-hidden border border-slate-200">
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="h-full w-full object-cover">
                @else
                    <div class="h-full w-full flex items-center justify-center text-6xl text-brand-200">📖</div>
                @endif
            </div>
        </div>
        <div class="lg:col-span-2">
            <span class="text-sm font-medium text-brand-600">{{ $book->category->name ?? 'Tanpa kategori' }}</span>
            <h2 class="mt-1 text-3xl font-bold text-slate-900">{{ $book->title }}</h2>
            <p class="mt-1 text-lg text-slate-600">oleh {{ $book->author }}</p>

            <dl class="mt-6 grid grid-cols-2 gap-4 text-sm">
                <div class="rounded-lg bg-white border border-slate-200 p-4"><dt class="text-slate-500">Penerbit</dt><dd class="mt-1 font-medium text-slate-800">{{ $book->publisher ?: '-' }}</dd></div>
                <div class="rounded-lg bg-white border border-slate-200 p-4"><dt class="text-slate-500">Tahun</dt><dd class="mt-1 font-medium text-slate-800">{{ $book->year ?: '-' }}</dd></div>
                <div class="rounded-lg bg-white border border-slate-200 p-4"><dt class="text-slate-500">ISBN</dt><dd class="mt-1 font-medium text-slate-800">{{ $book->isbn ?: '-' }}</dd></div>
                <div class="rounded-lg bg-white border border-slate-200 p-4"><dt class="text-slate-500">Stok Tersedia</dt><dd class="mt-1 font-medium text-slate-800">{{ $book->available_stock }} / {{ $book->stock }}</dd></div>
            </dl>

            @if ($book->description)
                <div class="mt-6">
                    <h3 class="font-semibold text-slate-800">Deskripsi</h3>
                    <p class="mt-2 text-slate-600 leading-relaxed">{{ $book->description }}</p>
                </div>
            @endif

            <div class="mt-8 flex items-center gap-3">
                @if (! auth()->user()->isAdmin() && $book->available_stock > 0)
                    <form method="POST" action="{{ route('loans.store') }}">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="rounded-lg bg-brand-600 px-6 py-2.5 font-semibold text-white hover:bg-brand-700 transition">Pinjam Buku</button>
                    </form>
                @elseif (! auth()->user()->isAdmin())
                    <span class="rounded-lg bg-red-50 px-4 py-2.5 text-sm font-medium text-red-700">Stok sedang habis</span>
                @endif
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('books.edit', $book) }}" class="rounded-lg bg-brand-600 px-6 py-2.5 font-semibold text-white hover:bg-brand-700 transition">Edit Buku</a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg border border-red-300 px-6 py-2.5 font-semibold text-red-600 hover:bg-red-50">Hapus</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
