<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('profile.blog.blog', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('profile.blog.add-blog', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:blogs,slug',
            'category_id'      => 'required|exists:categories,id',
            'content'          => 'required',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords'    => 'nullable|string|max:255',
            'tags'             => 'nullable|string',
            'canonical_url'    => 'nullable|url',
            'robots'           => 'nullable|string|max:50',
            'status'           => 'required|boolean',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/blogs'), $filename);
                $imagePath = 'uploads/blogs/' . $filename;
            }
            

            Blog::create([
                'title'            => $request->title,
                'slug'             => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
                'category_id'      => $request->category_id,
                'content'          => $request->content,
                'short_content'    => substr(strip_tags($request->short_content), 0, 200),
                'image'            => $imagePath,
                'meta_title'       => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords ?? null,
                'tags'             => $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : null,
                'canonical_url'    => $request->canonical_url,
                'robots'           => $request->robots ?? 'index, follow',
                'status'           => (int) $request->status,
            ]);

            return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
        } catch (\Exception $e) {
            \Log::error('Blog Store Error: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Something went wrong while saving the blog.');
        }
    }



    public function edit($id)
    {


        $blog = Blog::findOrFail($id);
        //  dd($blog);
        // exit;
        $blogs = Blog::with('category')->latest()->get();
        $categories = Category::all();
        return view('profile.blog.add-blog', compact('blog', 'blogs', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        try {
            $request->validate([
                'title'            => 'required|string|max:255',
                'slug'             => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
                'category_id'      => 'required|exists:categories,id',
                'content'          => 'required',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'meta_title'       => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'meta_keywords'    => 'nullable|string|max:255',
                'tags'             => 'nullable|string',
                'canonical_url'    => 'nullable|url',
                'robots'           => 'nullable|string|max:50',
                'status'           => 'required|boolean',
            ]);

            $imagePath = $blog->image;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image && file_exists(public_path($blog->image))) {
                    unlink(public_path($blog->image));
                }

                // Upload new image
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/blogs'), $filename);
                $imagePath = 'uploads/blogs/' . $filename;
            }

            $blog->update([
                'title'            => $request->title,
                'slug'             => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
                'category_id'      => $request->category_id,
                'content'          => $request->content,
                'short_content'    => substr(strip_tags($request->short_content), 0, 200),
                'image'            => $imagePath,
                'meta_title'       => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords'    => $request->meta_keywords ?? null,
                'tags'             => $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : null,
                'canonical_url'    => $request->canonical_url,
                'robots'           => $request->robots ?? 'index, follow',
                'status'           => $request->status,
            ]);

            return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Blog Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating the blog.');
        }
    }


    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
