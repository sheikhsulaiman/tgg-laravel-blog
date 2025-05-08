@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Blog Posts</h1>

    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($posts as $post)
        <x-post-card :post="$post" />
    @empty
        <p class="text-gray-700">No posts found.</p>
    @endforelse
</div>

    {{-- Pagination Links --}}
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
@endsection