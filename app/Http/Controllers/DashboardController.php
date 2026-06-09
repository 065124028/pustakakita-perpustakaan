<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $stats = [
                'books' => Book::count(),
                'categories' => Category::count(),
                'members' => User::where('role', 'anggota')->count(),
                'active_loans' => Loan::where('status', 'dipinjam')->count(),
            ];

            $recentLoans = Loan::with(['user', 'book'])
                ->latest()
                ->take(6)
                ->get();

            return view('dashboard', compact('stats', 'recentLoans'));
        }

        // Dashboard anggota
        $stats = [
            'my_active' => $user->loans()->where('status', 'dipinjam')->count(),
            'my_total' => $user->loans()->count(),
            'books' => Book::count(),
            'categories' => Category::count(),
        ];

        $recentLoans = $user->loans()
            ->with('book')
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard', compact('stats', 'recentLoans'));
    }
}
