@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('addUser') }}">
    @csrf
    <div class="container mt-4">
        <h1 class="mb-4">Add User</h1>
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="parent_id">Select Parent</label>
            <select id="parent_id" name="parent_id" class="form-control">
                <option value="">None</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </div>
</form>
@endsection
