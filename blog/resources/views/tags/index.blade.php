@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tags</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-primary">Create Tag</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group mt-3">
        @foreach ($tags as $tag)
            <li class="list-group-item">
                {{ $tag->name }}
                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
