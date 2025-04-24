<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Post $post) // Inject the Post model
    {
        // Validate the request data (use a specific error bag for comments)
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:100', // Optional name
            'body' => 'required|string|max:2000',
        ], [], ['body' => 'comment body']); // Custom attribute name for validation message

        // Create the comment and associate it with the post
        $post->comments()->create([
            'name' => $request->input('name', 'Anonymous'), // Default to 'Anonymous' if empty
            'body' => $validatedData['body'],
        ]);

        // Redirect back to the post show page with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }


    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Comment $comment) // Route model binding for Comment
    {
        // Pass the comment to the edit view
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment) // Route model binding for Comment
    {
         // Validate the request data
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:100',
            'body' => 'required|string|max:2000',
        ], [], ['body' => 'comment body']);

        // Update the comment
        $comment->update([
             'name' => $request->input('name', 'Anonymous'),
             'body' => $validatedData['body'],
        ]);

        // Redirect back to the post show page with a success message
        // We need the post to redirect back to its show page
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment) // Route model binding for Comment
    {
        $postId = $comment->post_id; // Get the post ID before deleting the comment
        $comment->delete();

        // Redirect back to the post show page with a success message
        return redirect()->route('posts.show', $postId)->with('success', 'Comment deleted successfully!');
    }
}