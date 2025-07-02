<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">Posts List</h2>
            <a href="{{ route('posts.create') }}" class="text-blue-600 font-medium hover:underline">
                + Create New Post
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="max-w-lg mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-6 mt-2">
        @if ($posts->isEmpty())
            <p class="text-gray-600 text-center">No posts found.</p>
        @else
            <ul class="space-y-6">
                @foreach ($posts as $post)
                    <li class="border border-gray-200 rounded-md p-4 hover:shadow-md transition-shadow">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $post->content }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
