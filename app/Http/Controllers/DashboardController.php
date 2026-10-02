<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'books' => Book::count(),
            'authors' => Author::count(),
            'categories' => Category::count(),
            'loansActive' => Loan::whereNull('returned_at')->count(),
            'loansOverdue' => Loan::whereNull('returned_at')
                ->where('borrowed_at', '<=', now()->subDays(15))
                ->count(),
        ];

        $recentLoans = Loan::with('book', 'user')->orderByDesc('borrowed_at')->take(5)->get();

        return view('dashboard', compact('stats', 'recentLoans'));
    }
}
