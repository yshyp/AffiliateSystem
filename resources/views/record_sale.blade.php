@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Record Sale</h1>
    <form method="POST" action="{{ route('recordSale') }}">
        @csrf
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select id="user_id" name="user_id" class="form-control" required>
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Sale Amount</label>
            <input type="number" id="amount" name="amount" class="form-control" placeholder="Sale Amount" required>
        </div>

        <button type="submit" class="btn btn-primary">Record Sale</button>
    </form>
</div>
@endsection
