<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class LoanController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('admin', only: ['returnBook']),
        ];
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        $query = Loan::with(['user', 'book.category'])->latest();

        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $loans = $query->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->available_stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang tidak tersedia.');
        }

        $alreadyBorrowing = Loan::where('user_id', $request->user()->id)
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($alreadyBorrowing) {
            return back()->with('error', 'Kamu masih meminjam buku ini dan belum mengembalikannya.');
        }

        Loan::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(7),
            'status' => 'dipinjam',
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Buku "'.$book->title.'" berhasil dipinjam. Harap kembalikan dalam 7 hari.');
    }

    public function returnBook(Loan $loan): RedirectResponse
    {
        if ($loan->status === 'dikembalikan') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        $loan->update([
            'status' => 'dikembalikan',
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Buku berhasil ditandai sebagai dikembalikan.');
    }
}
