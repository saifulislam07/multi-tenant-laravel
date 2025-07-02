<?php

namespace App\Http\Controllers\Tenant;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('tenant.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('tenant.posts.create');
    }

    public function store(Request $request)
    {
        dd(auth()->user());

        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
        ]);

        Post::create($request->only('title', 'content'));

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function edit(Post $post)
    {
        return view('tenant.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
        ]);

        $post->update($request->only('title', 'content'));

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }
}
