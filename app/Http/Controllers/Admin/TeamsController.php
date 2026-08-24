<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderBy('id', 'desc')->paginate(10);
        return view('profile.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.teams.create');
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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'twitter'     => 'nullable|url|max:255',
            'instagram'   => 'nullable|url|max:255',
            'pinterest'   => 'nullable|url|max:255',
            'facebook'    => 'nullable|url|max:255',
            'status'      => 'required|boolean',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/teams'), $filename);
                $imagePath = 'uploads/teams/' . $filename;
            }

            Team::create([
                'name'        => $request->name,
                'designation' => $request->designation,
                'image'       => $imagePath,
                'twitter'     => $request->twitter,
                'instagram'   => $request->instagram,
                'pinterest'   => $request->pinterest,
                'facebook'    => $request->facebook,
                'status'      => $request->status,
            ]);

            return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully!');

        } catch (\Exception $e) {
            \Log::error('Team Store Error: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Something went wrong while saving the team member.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::findOrFail($id);
        return view('profile.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::findOrFail($id);
        return view('profile.teams.create', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);

        // Validation
        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'twitter'     => 'nullable|url|max:255',
            'instagram'   => 'nullable|url|max:255',
            'pinterest'   => 'nullable|url|max:255',
            'facebook'    => 'nullable|url|max:255',
            'status'      => 'required|boolean',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($team->image && file_exists(public_path($team->image))) {
                    unlink(public_path($team->image));
                }
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/teams'), $filename);
                $team->image = 'uploads/teams/' . $filename;
            }

            // Update team member
            $team->update([
                'name'        => $request->name,
                'designation' => $request->designation,
                'twitter'     => $request->twitter,
                'instagram'   => $request->instagram,
                'pinterest'   => $request->pinterest,
                'facebook'    => $request->facebook,
                'status'      => $request->status,
            ]);

            return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Team Update Error: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Something went wrong while updating the team member.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);

        try {
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            $team->delete();
            return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Team Delete Error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting the team member.');
        }
    }
}
