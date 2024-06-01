@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Borrow Book</h1>
    <form action="{{ route('borrows.store', $book->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="book-title">Book Title</label>
            <input type="text" name="title" id="book-title" class="form-control" value="{{ $book->title }}" readonly>
        </div>
        <div class="form-group">
            <label for="borrower-name">Your Name</label>
            <input type="text" name="borrower_name" id="borrower-name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Borrow</button>
    </form>
</div>
@endsection
