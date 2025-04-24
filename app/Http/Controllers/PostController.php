<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request; // Import Request

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all posts, newest first
        $posts = Post::latest()->paginate(10); // Paginate results
        return view('posts.index', compact('posts')); // Pass posts to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create'); // Show the create form view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create a new post using mass assignment
        Post::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) // Route model binding
    {
        // Eager load comments to prevent N+1 problem
        $post->load('comments');
        return view('posts.show', compact('post')); // Pass the specific post to the view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) // Route model binding
    {
        return view('posts.edit', compact('post')); // Pass the post to the edit form view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) // Route model binding
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the post using mass assignment
        $post->update($validatedData);

        // Redirect to the post show page with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) // Route model binding
    {
        // Delete the post
        $post->delete();

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}