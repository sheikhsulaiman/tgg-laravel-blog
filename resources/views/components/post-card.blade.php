@props(['post'])

<div class="bg-green-50 shadow-md rounded-lg p-6 mb-6 hover:shadow-lg transition-shadow duration-300">
    <h2 class="text-2xl font-semibold text-green-700 mb-2">
        <a href="{{ route('posts.show', $post) }}" class="hover:underline">
            {{ $post->title }}
        </a>
    </h2>
    <p class="text-gray-600 mb-4">
        {{ Str::limit($post->body, 150) }}
    </p>
    <div class="text-sm text-gray-500 mb-4">
        Posted on {{ $post->created_at->format('M d, Y') }}
    </div>
    <div class="flex justify-between items-center">
        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">Read More &rarr;</a>
        <div>
            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-sm mr-2">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm">Delete</button>
            </form>
        </div>
    </div>
</div>
