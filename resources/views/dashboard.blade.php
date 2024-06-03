@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Books List</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ date('Y', strtotime($book->created_at)) }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('borrows.create', $book->id) }}" class="btn btn-success btn-sm">Borrow</a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $book->id }}">Delete</button>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this book?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Custom pagination controls -->
<div class="d-flex justify-content-center">
    @if ($books->lastPage() > 1)
        <ul class="pagination">
            <li class="page-item {{ ($books->currentPage() == 1)? 'isabled' : '' }}">
                <a class="page-link" href="{{ $books->url(1) }}">First</a>
            </li>
            <li class="page-item {{ ($books->currentPage() == 1)? 'isabled' : '' }}">
                <a class="page-link" href="{{ $books->previousPageUrl() }}">< Previous</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">{{ $books->currentPage() }}</a>
            </li>
            <li class="page-item {{ ($books->currentPage() == $books->lastPage())? 'isabled' : '' }}">
                <a class="page-link" href="{{ $books->nextPageUrl() }}">Next ></a>
            </li>
            <li class="page-item {{ ($books->currentPage() == $books->lastPage())? 'isabled' : '' }}">
                <a class="page-link" href="{{ $books->url($books->lastPage()) }}">Last</a>
            </li>
        </ul>
    @endif
</div>
</div>
@endsection