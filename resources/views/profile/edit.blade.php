@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')
        <!-- Fields for profile information update -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <h2>Borrowed Books</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Borrowed At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrows as $borrow)
                @if(is_null($borrow->returned_at))
                <tr>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->book->author }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('borrows.return', $borrow->book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Return</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
