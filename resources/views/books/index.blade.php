@extends('layouts.app')

@section('title', 'Buku')
@section('header', 'Koleksi Buku')
@section('subheader', 'Telusuri dan pinjam buku yang tersedia')

@section('actions')
    @if (auth()->user()->isAdmin())
        <a href="{{ route('books.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-brand-600 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-700 transition">+ Tambah Buku</a>
    @endif
@endsection

@section('content')
    <form method="GET" action="{{ route('books.index') }}" class="mb-6 flex flex-wrap items-center gap-3">
        <input name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis, atau ISBN..."
            class="flex-1 min-w-[200px] rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
        <select name="category" class="rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (string) request('category') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-semibold text-white hover:bg-brand-700">Cari</button>
    </form>

    @if ($books->isEmpty())
        <div class="rounded-xl bg-white border border-slate-200 p-12 text-center text-slate-400">Tidak ada buku yang cocok.</div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($books as $book)
                <div class="group rounded-xl bg-white shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                    <div class="aspect-[3/4] bg-slate-100 overflow-hidden">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="h-full w-full object-cover group-hover:scale-105 transition">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-5xl text-brand-200">📖</div>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <span class="text-xs font-medium text-brand-600">{{ $book->category->name ?? 'Tanpa kategori' }}</span>
                        <h3 class="mt-1 font-semibold text-slate-800 leading-snug line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-sm text-slate-500">{{ $book->author }}</p>
                        <div class="mt-3 flex items-center justify-between">
                            @if ($book->available_stock > 0)
                                <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Tersedia: {{ $book->available_stock }}</span>
                            @else
                                <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-700">Stok habis</span>
                            @endif
                        </div>
                        <div class="mt-4 flex items-center gap-2 pt-3 border-t border-slate-100">
                            <a href="{{ route('books.show', $book) }}" class="flex-1 text-center rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Detail</a>
                            @if (! auth()->user()->isAdmin() && $book->available_stock > 0)
                                <form method="POST" action="{{ route('loans.store') }}" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="w-full rounded-lg bg-brand-600 px-3 py-2 text-sm font-semibold text-white hover:bg-brand-700">Pinjam</button>
                                </form>
                            @endif
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('books.edit', $book) }}" class="flex-1 text-center rounded-lg bg-brand-600 px-3 py-2 text-sm font-semibold text-white hover:bg-brand-700">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $books->links() }}</div>
    @endif
@endsection
