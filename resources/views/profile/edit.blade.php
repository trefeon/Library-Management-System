@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            Profile updated successfully.
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH') <!-- Ubah dari PUT ke PATCH -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <hr>
    <h2>Delete Account</h2>
    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-danger">Delete Account</button>
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
