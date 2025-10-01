<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\Role;
use App\Services\Dashboard\AdminService;
use App\Services\Dashboard\RoleService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $adminService, $roleService;

    public function __construct(AdminService $adminService, RoleService $roleService)
    {
        $this->adminService = $adminService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('dashboard.pages.admins.index', compact('admins'));
    }


    public function create()
    {
        $roles = $this->roleService->getRoles();
        return view('dashboard.pages.admins.create', compact('roles'));
    }


    public function store(StoreAdminRequest $request)
    {
        $admin = $this->adminService->createAdmin($request);
        if (!$admin) {
            return redirect()->back()->with('error', __('dashboard_admins.messages.something_wrong'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('dashboard_admins.messages.created_successfully'));
    }


    public function edit(string $id)
    {
        $admin = $this->adminService->getAdminById($id);

        if (!$admin) {
            return redirect()->back()->with('error', __('dashboard_admins.messages.not_found'));
        }

        $roles = Role::active()->get();
        return view('dashboard.pages.admins.edit', compact('admin', 'roles'));
    }


    public function update(UpdateAdminRequest $request, string $id)
    {
        $admin = $this->adminService->updateAdmin($id, $request);
        if (!$admin) {
            return redirect()->back()->with('error', __('dashboard_admins.messages.something_wrong'));
        }
        return redirect()->route('dashboard.admins.index')->with('success', __('dashboard_admins.messages.updated_successfully'));
    }


    public function destroy(string $id)
    {
        $result = $this->adminService->deleteAdmin($id);

        if (!$result) {
            // Check if admin exists
            $admin = $this->adminService->getAdminById($id);
            if (!$admin) {
                return redirect()->back()->with('error', __('dashboard_admins.messages.not_found'));
            }

            return redirect()->back()->with('error', __('dashboard_admins.messages.delete_failed'));
        }

        return redirect()->route('dashboard.admins.index')->with('success', __('dashboard_admins.messages.deleted_successfully'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:admins,id'],
            'status' => 'required|in:active,inactive',
        ]);

        $admin = $this->adminService->updateStatus($request->id, $request->status);
        if (!$admin) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('dashboard_admins.messages.something_wrong')
                ], 500);
            }
            return redirect()->back()->with('error', __('dashboard_admins.messages.something_wrong'));
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('dashboard_admins.messages.status_updated_successfully')
            ]);
        }

        return redirect()->route('dashboard.admins.index')->with('success', __('dashboard_admins.messages.status_updated_successfully'));
    }
}
