<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
         $categories = Category::latest()->paginate(3);
        return view('profile.blog.cat', compact('categories'));
    }

    public function create()
    {
        return view('profile.blog.add-cat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'nullable|string|unique:categories,slug',
        ]);

        $data = $request->only(['name', 'slug','status']);
        $data['slug'] = $data['slug'] ?: Str::slug($request->name);
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('profile.blog.add-cat', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'nullable|string|unique:categories,slug,' . $category->id,
        ]);

        $data = $request->only(['name', 'slug', 'status']);
        $data['slug'] = $data['slug'] ?: Str::slug($request->name);
        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
