<?php

namespace App\Repositories\Dashboard;

use App\Models\Admin;

class AdminRepository
{
    public function getAdmins()
    {
        return Admin::with('role')
            ->select('id', 'name', 'email', 'role_id', 'status', 'created_at')
            ->paginate(9)
            ->withQueryString();
    }

    public function getAdminById($id)
    {
        return Admin::with('role')->find($id);
    }

    public function createAdmin($data)
    {
        return Admin::create($data);
    }

    public function updateAdmin($id, $data)
    {
        $admin = $this->getAdminById($id);
        if (!$admin) {
            return false;
        }

        $admin->update($data);
        return $admin->fresh();
    }

    public function deleteAdmin($id)
    {
        $admin = $this->getAdminById($id);
        if (!$admin) {
            return false;
        }

        $admin->delete();
        return true;
    }

    public function updateStatus($id, $status)
    {
        $admin = $this->getAdminById($id);
        if (!$admin) {
            return false;
        }

        $admin->update(['status' => $status]);
        return $admin->fresh();
    }
}
