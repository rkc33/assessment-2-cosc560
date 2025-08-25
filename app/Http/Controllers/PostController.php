<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::with(['user','category'])->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Show edit form
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post','categories'));
    }

    // Handle create & update
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->id) {
            // update
            $post = Post::findOrFail($request->id);
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'is_active' => $request->is_active ?? 'Yes',
            ]);
        } else {
            // create new
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'is_active' => $request->is_active ?? 'Yes',
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.posts.all')->with('success', 'Post saved successfully!');
    }

    // Delete post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.all')->with('success', 'Post deleted successfully!');
    }
}
