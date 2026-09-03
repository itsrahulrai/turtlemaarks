<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientVideo;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PatientVideoController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $videos = PatientVideo::orderBy('sort_order')->latest()->paginate(20);
        return view('admin.patient-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.patient-videos.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->imageService->store($request->file('thumbnail'), 'patient-videos');
        }

        PatientVideo::create($data);

        return redirect()->route('admin.patient-videos.index')->with('success', 'Video added to the homepage section.');
    }

    public function edit(PatientVideo $patientVideo)
    {
        return view('admin.patient-videos.create', ['video' => $patientVideo]);
    }

    public function update(Request $request, PatientVideo $patientVideo)
    {
        $data = $this->validated($request);

        if ($request->hasFile('thumbnail')) {
            $this->imageService->delete($patientVideo->thumbnail);
            $data['thumbnail'] = $this->imageService->store($request->file('thumbnail'), 'patient-videos');
        }

        $patientVideo->update($data);

        return redirect()->route('admin.patient-videos.index')->with('success', 'Video updated.');
    }

    public function destroy(PatientVideo $patientVideo)
    {
        $this->imageService->delete($patientVideo->thumbnail);
        $patientVideo->delete();

        return back()->with('success', 'Video removed.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'youtube_id'        => 'required|string|max:50',
            'topic_label'       => 'required|string|max:100',
            'title'             => 'required|string|max:150',
            'card_description'  => 'required|string|max:255',
            'badge'             => 'nullable|string|max:60',
            'duration'          => 'nullable|string|max:20',
            'location'          => 'nullable|string|max:100',
            'modal_title'       => 'nullable|string|max:200',
            'modal_badge'       => 'nullable|string|max:60',
            'speaker'           => 'nullable|string|max:150',
            'modal_description' => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:2048',
            'is_active'         => 'boolean',
            'sort_order'        => 'nullable|integer',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
