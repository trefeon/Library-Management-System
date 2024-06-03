@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>
    <p>Author: {{ $book->author }}</p>
    <p>Published Year: {{ $book->published_year }}</p>
    <p>Description: {{ $book->description }}</p>
    <a href="{{ route('borrows.create', $book->id) }}" class="btn btn-warning">Borrow</a>
</div>
@endsection