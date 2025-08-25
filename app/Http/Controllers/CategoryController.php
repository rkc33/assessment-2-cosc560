<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('categories.create');
    }

    // Show edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Handle create & update
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'content' => 'nullable|string',
        ]);

        if ($request->id) {
            $category = Category::findOrFail($request->id);
            $category->update([
                'name' => $request->name,
                'content' => $request->content,
            ]);
        } else {
            Category::create([
                'name' => $request->name,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('admin.categories.all')->with('success', 'Category saved successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.all')->with('success', 'Category deleted successfully!');
    }
}
