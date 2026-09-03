<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $admins = Admin::with('assignedRole')->latest()->paginate(20);
        return view('admin.admin-users.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.admin-users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:admins,email',
            'phone'     => 'nullable|string|max:20',
            'password'  => 'required|string|min:8|confirmed',
            'role_id'   => 'nullable|exists:roles,id',
            'avatar'    => 'nullable|image|max:1024',
            'is_active' => 'boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->boolean('is_active');
        $data['role'] = 'staff';

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->imageService->store($request->file('avatar'), 'admins');
        }

        Admin::create($data);

        return redirect()->route('admin.admin-users.index')->with('success', 'Admin user created.');
    }

    public function edit(Admin $adminUser)
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.admin-users.create', ['admin' => $adminUser, 'roles' => $roles]);
    }

    public function update(Request $request, Admin $adminUser)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:admins,email,' . $adminUser->id,
            'phone'     => 'nullable|string|max:20',
            'password'  => 'nullable|string|min:8|confirmed',
            'role_id'   => 'nullable|exists:roles,id',
            'avatar'    => 'nullable|image|max:1024',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $this->imageService->delete($adminUser->avatar);
            $data['avatar'] = $this->imageService->store($request->file('avatar'), 'admins');
        }

        $adminUser->update($data);

        return redirect()->route('admin.admin-users.index')->with('success', 'Admin user updated.');
    }

    public function destroy(Admin $adminUser)
    {
        if ($adminUser->id === auth('admin')->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $this->imageService->delete($adminUser->avatar);
        $adminUser->delete();

        return back()->with('success', 'Admin user removed.');
    }
}
