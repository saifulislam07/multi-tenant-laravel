<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">Create New Post</h2>
            <a href="{{ route('posts.index') }}" class="text-blue-600 font-medium hover:underline">
                ← Posts List
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-8 mt-2">
        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block mb-2 font-medium text-gray-700">Title <span
                        class="text-red-500">*</span></label>
                <input id="title" name="title" type="text" placeholder="Enter post title"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    required value="{{ old('title') }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block mb-2 font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" rows="5" placeholder="Write your post content here..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-md resize-y focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
                Create Post
            </button>
        </form>
    </div>
</x-app-layout>
