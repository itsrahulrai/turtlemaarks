<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('profile.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validation
        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'image'       => 'nullable|image',
            'text'        => 'required|string',
            'rating'      => 'required|integer|min:1|max:5',
            'status'      => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $imagePath = 'uploads/testimonials/' . $filename;
        }

        Testimonial::create([
            'name'        => $request->name,
            'designation' => $request->designation,
            'image'       => $imagePath,
            'text'        => $request->text,
            'rating'      => $request->rating,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
         public function edit($id)
        {
            $testimonial = Testimonial::findOrFail($id);
            // dd($testimonial);
            // exit; 
            return view('profile.testimonials.create', compact('testimonial'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      

        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
           'image'       => 'nullable|image',
            'text'        => 'required|string',
            'rating'      => 'required|integer|min:1|max:5',
            'status'      => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonial->image = 'uploads/testimonials/' . $filename;
        }

        $testimonial->update([
            'name'        => $request->name,
            'designation' => $request->designation,
            'text'        => $request->text,
            'rating'      => $request->rating,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}
