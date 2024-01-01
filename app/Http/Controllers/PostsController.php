<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['author', 'tags'])->filter(request(['sort']))->get();
        return Inertia::render('Home', ['posts' => $posts]);
    }

    /**
     * Display a listing based on tag.
     */
    public function with_tag($tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('key', $tag);
        })->with('author', 'tags')->filter(request(['sort']))->get();

        return Inertia::render('Home', ['tag' => $tag, 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::with(['author', 'tags'])->where('slug', $slug)->first();
        return Inertia::render('PostView', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
