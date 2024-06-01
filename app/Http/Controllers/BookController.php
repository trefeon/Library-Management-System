<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(5);
        return view('dashboard', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('dashboard');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
