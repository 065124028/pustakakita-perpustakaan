@extends('layouts.app')

@section('title', 'Edit Buku')
@section('header', 'Edit Buku')

@section('content')
    <div class="max-w-3xl rounded-xl bg-white shadow-sm border border-slate-200 p-6">
        <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            @include('books._form', ['book' => $book])
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-brand-600 px-5 py-2.5 font-semibold text-white hover:bg-brand-700 transition">Perbarui Buku</button>
                <a href="{{ route('books.index') }}" class="rounded-lg px-5 py-2.5 font-medium text-slate-600 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
@endsection
