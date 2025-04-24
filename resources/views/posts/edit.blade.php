@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Post: {{ $post->title }}</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf {{-- CSRF Protection Token --}}
        @method('PUT') {{-- Method Spoofing for PUT request --}}

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" required>
             @error('title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body:</label>
            <textarea id="body" name="body" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('body') border-red-500 @enderror" required>{{ old('body', $post->body) }}</textarea>
             @error('body')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Post
            </button>
            <a href="{{ route('posts.show', $post) }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
@endsection