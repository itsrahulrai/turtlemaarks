<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    // Display all galleries
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('profile.gallery.index', compact('galleries'));
    }

    // Show create form
    public function create()
    {
        return view('profile.gallery.create');
    }

    // Store new gallery
    public function store(Request $request)
    {
        $request->validate([
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            $imagePath = 'uploads/gallery/' . $filename;
        }

        Gallery::create([
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery added successfully!');
    }

    // Show edit form
    public function edit(Gallery $gallery)
    {
        return view('profile.gallery.create', compact('gallery'));
    }

    // Update gallery
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        // Upload image if provided
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            $gallery->image = 'uploads/gallery/' . $filename;
        }
        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated successfully!');
    }

    // Delete gallery
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && File::exists(public_path($gallery->image))) {
            File::delete(public_path($gallery->image));
        }
        $gallery->delete();
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery deleted successfully!');
    }
}
