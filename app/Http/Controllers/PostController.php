<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Show create post form
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Store a new post
    public function store(Request $request)
    {

        if (!auth()->user()->is_admin) {
        abort(403, 'You are not authorized.');
    }
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Post::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'is_active'   => $request->is_active ?? 'Yes',
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('posts.all')->with('success', 'Post created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title'       => $request->title,
            'content'     => $request->content,
            'category_id' => $request->category_id,
            'is_active'   => $request->is_active ?? 'Yes',
        ]);

        return redirect()->route('posts.all')->with('success', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.all')->with('success', 'Post deleted successfully!');
    }
}
