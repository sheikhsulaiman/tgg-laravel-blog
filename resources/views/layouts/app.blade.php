<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Simple Blog')</title>
    @vite('resources/css/app.css') {{-- Link Tailwind via Vite --}}
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="text-lg font-semibold">Simple Blog</a>
            <a href="{{ route('posts.create') }}" class="bg-white text-blue-600 hover:bg-gray-200 font-bold py-2 px-4 rounded">
                Create Post
            </a>
        </div>
    </nav>

    <main class="container mx-auto mt-8 mb-8 p-4">
        {{-- Session messages for success/error --}}
        @if (session('success'))
            <div class="bg-green-200 text-green-800 border border-green-400 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
         @if (session('error'))
            <div class="bg-red-200 text-red-800 border border-red-400 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Validation Errors --}}
         @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Something went wrong.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content') {{-- Page specific content will go here --}}
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mt-auto">
        My Simple Blog &copy; {{ date('Y') }}
    </footer>

    @vite('resources/js/app.js') {{-- Include JS if needed --}}
</body>
</html>