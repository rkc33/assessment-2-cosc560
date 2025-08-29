<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('categories.all')->with('success', 'Category created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Update existing category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('categories.all')->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.all')->with('success', 'Category deleted successfully!');
    }
}
