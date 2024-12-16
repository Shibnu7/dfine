@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Tag</h1>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tag Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
