@extends('layouts.app')

@section('title', 'Peminjaman')
@section('header', 'Data Peminjaman')
@section('subheader', auth()->user()->isAdmin() ? 'Semua transaksi peminjaman buku' : 'Riwayat peminjaman buku kamu')

@section('actions')
    <a href="{{ route('books.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Pinjam Buku</a>
@endsection

@section('content')
    @php($admin = auth()->user()->isAdmin())
    <div class="rounded-xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-medium">Buku</th>
                        @if ($admin)<th class="px-5 py-3 font-medium">Peminjam</th>@endif
                        <th class="px-5 py-3 font-medium">Tgl Pinjam</th>
                        <th class="px-5 py-3 font-medium">Jatuh Tempo</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        @if ($admin)<th class="px-5 py-3 font-medium text-right">Aksi</th>@endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($loans as $loan)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-medium text-slate-800">{{ $loan->book->title ?? '-' }}</td>
                            @if ($admin)<td class="px-5 py-3 text-slate-600">{{ $loan->user->name ?? '-' }}</td>@endif
                            <td class="px-5 py-3 text-slate-600">{{ $loan->borrowed_at?->format('d M Y') }}</td>
                            <td class="px-5 py-3">
                                <span class="{{ $loan->is_overdue ? 'text-red-600 font-medium' : 'text-slate-600' }}">{{ $loan->due_at?->format('d M Y') }}</span>
                                @if ($loan->is_overdue)<span class="ml-1 text-xs text-red-500">(terlambat)</span>@endif
                            </td>
                            <td class="px-5 py-3">
                                @if ($loan->status === 'dipinjam')
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-700">Dipinjam</span>
                                @else
                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Dikembalikan</span>
                                @endif
                            </td>
                            @if ($admin)
                                <td class="px-5 py-3 text-right">
                                    @if ($loan->status === 'dipinjam')
                                        <form method="POST" action="{{ route('loans.return', $loan) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="rounded-md bg-brand-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-brand-700">Tandai Kembali</button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400">{{ $loan->returned_at?->format('d M Y') }}</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-slate-400">Belum ada peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $loans->links() }}</div>
@endsection
