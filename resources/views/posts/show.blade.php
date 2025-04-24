@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="bg-white shadow-md rounded-lg p-8 mb-8">
        <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $post->title }}</h1>
        <p class="text-gray-600 text-sm mb-6">
            Posted on {{ $post->created_at->format('F j, Y') }}
        </p>
        <div class="prose max-w-none text-gray-800 leading-relaxed">
             {!! nl2br(e($post->body)) !!} {{-- Use nl2br to respect new lines, e() for escaping --}}
        </div>

        <div class="mt-6 flex justify-end space-x-2">
             <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit Post</a>
             <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete Post</button>
             </form>
        </div>
    </div>

    {{-- Comments Section --}}
    <div class="bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Comments ({{ $post->comments->count() }})</h2>

        {{-- Add Comment Form --}}
        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
            @csrf
            <div class="mb-4">
                 <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name (Optional):</label>
                 <input type="text" id="name" name="name" value="{{ old('name', 'Anonymous') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
             </div>
            <div class="mb-4">
                <label for="comment_body" class="block text-gray-700 text-sm font-bold mb-2">Your Comment:</label>
                <textarea id="comment_body" name="body" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('body', 'comment') border-red-500 @enderror" required>{{ old('body') }}</textarea>
                 @error('body', 'comment') {{-- Specific error bag for comments --}}
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Comment
            </button>
        </form>

        {{-- Display Comments --}}
        <div class="space-y-6">
            @forelse ($post->comments as $comment)
                <div class="border-l-4 border-blue-200 pl-4 pb-4 pt-2 bg-gray-50 rounded">
                    <p class="text-gray-700 mb-2">{!! nl2br(e($comment->body)) !!}</p>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold">{{ $comment->name }}</span> commented on {{ $comment->created_at->diffForHumans() }}
                         <div class="inline-block ml-4 space-x-2">
                            <a href="{{ route('comments.edit', $comment) }}" class="text-yellow-600 hover:underline text-xs">Edit</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">&larr; Back to all posts</a>
    </div>
@endsection