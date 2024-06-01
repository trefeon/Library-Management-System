@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Books List</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add Book</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('borrows.create', $book->id) }}" class="btn btn-success">Borrow</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Custom pagination controls -->
    <div class="d-flex justify-content-center">
        @if ($books->lastPage() > 1)
            <ul class="pagination">
                <li class="page-item {{ ($books->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $books->url(1) }}">First</a>
                </li>
                <li class="page-item {{ ($books->currentPage() == 1) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $books->previousPageUrl() }}">< Previous</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">{{ $books->currentPage() }}</a>
                </li>
                <li class="page-item {{ ($books->currentPage() == $books->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $books->nextPageUrl() }}">Next ></a>
                </li>
                <li class="page-item {{ ($books->currentPage() == $books->lastPage()) ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $books->url($books->lastPage()) }}">Last</a>
                </li>
            </ul>
        @endif
    </div>
</div>
@endsection
