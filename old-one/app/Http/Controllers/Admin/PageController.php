<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


    class PageController extends Controller
    {
        /**
         * Display a listing of the pages.
         */
            public function index() 
            {
                $pages = Page::latest()->paginate(10);

                return view('profile.pages.index', compact('pages'));
            }

        /**
         * Show create OR edit form on the same page.
         */
        public function create()
        {
            $page = null;
            return view('profile.pages.create', compact('page'));
        }

        /**
         * Store a newly created page.
         */
        public function store(Request $request)
        {
            $request->validate([
                'name'  => 'required|string|max:255',
                'content' => 'nullable',
                'image' => 'nullable|image',
            ]);

            // Upload image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file     = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/pages'), $filename);
                $imagePath = 'uploads/pages/' . $filename;
            }

            // Auto slug
            $slug = Str::slug($request->slug ?: $request->name);

            // Check duplicate slug
            $count = Page::where('slug', $slug)->count();
            if ($count > 0) {
                $slug .= '-' . time();
            }

            Page::create([
                'name'              => $request->name,
                'slug'              => $slug,
                'content'           => $request->content,
                'image'             => $imagePath,
                'alt'               => $request->alt,
                'meta_title'        => $request->meta_title,
                'canonical_url'     => $request->canonical_url,
                'meta_description'  => $request->meta_description,
                'meta_keywords'     => $request->meta_keywords,
                'og_title'          => $request->og_title,
                'og_description'    => $request->og_description,
                'visibility'        => $request->visibility ?? 1,
                'index_status'      => $request->index_status ?? 1,
                'follow_status'     => $request->follow_status ?? 1,
                'status'            => $request->status ?? 1,
            ]);

            return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
        }

        /**
         * Edit page (same page as create).
         */
        public function edit($id)
        {
            $page = Page::findOrFail($id);
            return view('profile.pages.create', compact('page'));
        }

        /**
         * Update the specified page.
         */
        public function update(Request $request, $id)
        {
            $page = Page::findOrFail($id);

            $request->validate([
                'name'    => 'required|string|max:255',
                'image'   => 'nullable|image',
            ]);

            // Upload image
            $imagePath = $page->image;
            if ($request->hasFile('image')) {

                // Delete old image
                if ($page->image && file_exists(public_path($page->image))) {
                    unlink(public_path($page->image));
                }

                $file     = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/pages'), $filename);
                $imagePath = 'uploads/pages/' . $filename;
            }

            // Slug
            $slug = Str::slug($request->slug ?: $request->name);

            // Ensure slug unique
            $count = Page::where('slug', $slug)->where('id', '!=', $id)->count();
            if ($count > 0) {
                $slug .= '-' . time();
            }

            $page->update([
                'name'              => $request->name,
                'slug'              => $slug,
                'content'           => $request->content,
                'image'             => $imagePath,
                'alt'               => $request->alt,
                'meta_title'        => $request->meta_title,
                'canonical_url'     => $request->canonical_url,
                'meta_description'  => $request->meta_description,
                'meta_keywords'     => $request->meta_keywords,
                'og_title'          => $request->og_title,
                'og_description'    => $request->og_description,
                'visibility'        => $request->visibility,
                'index_status'      => $request->index_status,
                'follow_status'     => $request->follow_status,
                'status'            => $request->status,
            ]);

            return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
        }

        /**
         * Remove the specified page.
         */
        public function destroy($id)
        {
            $page = Page::findOrFail($id);

            if ($page->image && file_exists(public_path($page->image))) {
                unlink(public_path($page->image));
            }

            $page->delete();

            return redirect()->route('admin.page.index')->with('success', 'Page deleted successfully!');
        }
    }
