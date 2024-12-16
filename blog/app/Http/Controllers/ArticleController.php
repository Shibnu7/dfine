<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag; // Import the Tag model
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'tags'])->get(); // Include tags
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all(); // Fetch all tags
        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'category_id' => 'required',
            'tags' => 'array', // Validate tags as an array
            'tags.*' => 'exists:tags,id' // Validate each tag exists
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        // Store the image in the public disk
        $article->image = $request->file('image')->store('images', 'public');
        $article->category_id = $request->category_id;
        $article->save();

        // Attach tags to the article
        if ($request->has('tags')) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show($id)
    {
        $article = Article::with(['category', 'tags'])->findOrFail($id); // Include tags
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::with('tags')->findOrFail($id); // Include tags
        $categories = Category::all();
        $tags = Tag::all(); // Fetch all tags
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image',
            'category_id' => 'required',
            'tags' => 'array', // Validate tags as an array
            'tags.*' => 'exists:tags,id' // Validate each tag exists
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->description = $request->description;

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Store the new image in the public disk
            $article->image = $request->file('image')->store('images', 'public');
        }

        $article->category_id = $request->category_id;
        $article->save();

        // Sync tags with the article
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags); // Use sync to update tags
        } else {
            $article->tags()->detach(); // Detach tags if none are selected
        }

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        Article::destroy($id);
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
