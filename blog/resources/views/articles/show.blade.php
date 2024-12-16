@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    
    <!-- Display the image with a custom class for resizing -->
    @if($article->image)
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid resized-image">
    @else
        <p>No image available.</p>
    @endif

    <p>{{ $article->description }}</p>
    
    <h5>Category: {{ $article->category->name }}</h5>
    
    <h5>Tags:</h5>
    <ul>
        @foreach ($article->tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to Articles</a>
    <div class="mt-2">
        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<style>
    .resized-image {
        max-width: 100%;  /* Responsive width */
        height: 200px;     /* Maintain aspect ratio */
        width: 150px;     /* Set a standard width */
    }
</style>

@endsection
