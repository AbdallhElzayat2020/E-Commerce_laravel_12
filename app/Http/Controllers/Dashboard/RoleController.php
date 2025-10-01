<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreRoleRequest;
use App\Http\Requests\Dashboard\UpdateRoleRequest;
use App\Models\Role;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->roleService->createRole($request);
        if (!$role) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('dashboard.roles.index')->with('success', 'Role created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.pages.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $role = $this->roleService->editRole($id, $request);
        if (!$role) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->route('dashboard.roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->roleService->delete($id);

        if (!$result) {
            // Check if role exists
            $role = $this->roleService->getRoleById($id);
            if (!$role) {
                return redirect()->back()->with('error', 'Role not found');
            }

            if ($role->admins()->count() > 0) {
                return redirect()->back()->with('error', 'Cannot delete role with associated admins');
            }

            return redirect()->back()->with('error', 'Failed to delete role');
        }

        return redirect()->route('dashboard.roles.index')->with('success', 'Role deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:roles,id'],
            'status' => 'required|in:active,inactive',
        ]);

        $role = $this->roleService->updateStatus($request->id, $request->status);
        if (!$role) {
            return redirect()->back()->with('error', 'Something went wrong please try again');
        }

        return redirect()->route('dashboard.roles.index')->with('success', 'Role status updated successfully');
    }
}
