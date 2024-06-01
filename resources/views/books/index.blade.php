@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add Book</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Published Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->published_year }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('borrows.create', $book->id) }}" class="btn btn-warning">Borrow</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
