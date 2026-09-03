<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    private function rules(?Service $service = null): array
    {
        return [
            'name'              => 'required|string|max:150',
            'slug'              => 'nullable|string|unique:services,slug,' . $service?->id,
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'duration_minutes'  => 'required|integer|min:5',
            'image'             => 'nullable|image|max:2048',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:160',
            'meta_description'  => 'nullable|string|max:300',
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $data['slug']      = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->store($request->file('image'), 'services');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.create', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate($this->rules($service));

        $data['slug']      = $data['slug'] ?? Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $this->imageService->delete($service->image);
            $data['image'] = $this->imageService->store($request->file('image'), 'services');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->appointments()->exists()) {
            return back()->with('error', 'Cannot delete a service with existing appointments.');
        }

        $this->imageService->delete($service->image);
        $service->delete();

        return back()->with('success', 'Service deleted.');
    }
}
