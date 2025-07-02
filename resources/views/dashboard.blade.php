<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="max-w-lg mx-auto py-6">
        <p class="mb-6 text-gray-700">
            Welcome back! Use the button below to create a new post.
        </p>

        <a href="{{ route('posts.create') }}"
            class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
            + Create New Post
        </a>
    </div>

    {{-- You can add posts listing here later --}}
</x-app-layout>
