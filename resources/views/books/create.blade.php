@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('header', 'Tambah Buku')

@section('content')
    <div class="max-w-3xl rounded-xl bg-white shadow-sm border border-slate-200 p-6">
        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('books._form', ['book' => null])
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-brand-600 px-5 py-2.5 font-semibold text-white hover:bg-brand-700 transition">Simpan Buku</button>
                <a href="{{ route('books.index') }}" class="rounded-lg px-5 py-2.5 font-medium text-slate-600 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
@endsection
