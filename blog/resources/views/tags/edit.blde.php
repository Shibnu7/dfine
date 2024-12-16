@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tag</h1>
    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tag Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
