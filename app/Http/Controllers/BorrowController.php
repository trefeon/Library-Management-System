<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function create(Book $book)
    {
        $user = Auth::user();

        Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Book borrowed successfully!');
    }

    public function store(Request $request, Book $book)
    {
        // Tidak ada implementasi store karena create langsung menangani borrow
    }

    public function return(Book $book)
    {
        $user = Auth::user();

        $borrow = Borrow::where('user_id', $user->id)
                        ->where('book_id', $book->id)
                        ->whereNull('returned_at')
                        ->first();

        if ($borrow) {
            $borrow->returned_at = now();
            $borrow->save();

            return redirect()->route('profile.edit')->with('success', 'Book returned successfully!');
        }

        return redirect()->route('profile.edit')->with('error', 'Failed to return the book!');
    }
}

