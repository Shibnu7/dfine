@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create Article</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group mt-3">
        @foreach ($articles as $article)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                </h5>
                <div>
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
