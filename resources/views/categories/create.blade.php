@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('header', 'Tambah Kategori')

@section('content')
    <div class="max-w-2xl rounded-xl bg-white shadow-sm border border-slate-200 p-6">
        <form method="POST" action="{{ route('categories.store') }}" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Nama Kategori</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none"
                    placeholder="mis. Novel, Teknologi">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi <span class="text-slate-400">(opsional)</span></label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none"
                    placeholder="Deskripsi singkat kategori">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-brand-600 px-5 py-2.5 font-semibold text-white hover:bg-brand-700 transition">Simpan</button>
                <a href="{{ route('categories.index') }}" class="rounded-lg px-5 py-2.5 font-medium text-slate-600 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
@endsection
