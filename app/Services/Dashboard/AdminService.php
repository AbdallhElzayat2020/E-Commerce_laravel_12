<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAdmins()
    {
        return $this->adminRepository->getAdmins();
    }

    public function getAdminById($id)
    {
        return $this->adminRepository->getAdminById($id);
    }

    public function createAdmin($request)
    {
        $data = $request->validated();

        // Hash password
        $data['password'] = Hash::make($data['password']);

        return $this->adminRepository->createAdmin($data);
    }

    public function updateAdmin($id, $request)
    {
        $data = $request->validated();

        // Check if admin exists
        $admin = $this->adminRepository->getAdminById($id);
        if (!$admin) {
            return false;
        }

        // Prevent updating super admin
        if ($admin->id === 1) {
            return false;
        }

        // Hash password if exist
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->adminRepository->updateAdmin($id, $data);
    }

    public function deleteAdmin($id)
    {
        // Check if admin exists
        $admin = $this->adminRepository->getAdminById($id);
        if (!$admin) {
            return false;
        }

        // Prevent deleting super admin
        if ($admin->id === 1) {
            return false;
        }

        return $this->adminRepository->deleteAdmin($id);
    }

    public function updateStatus($id, $status)
    {
        // Check if admin exists
        $admin = $this->adminRepository->getAdminById($id);
        if (!$admin) {
            return false;
        }

        // Prevent changing super admin status
        if ($admin->id === 1) {
            return false;
        }

        // Validate status
        if (!in_array($status, ['active', 'inactive'])) {
            return false;
        }

        // Update status
        $updatedAdmin = $this->adminRepository->updateStatus($id, $status);

        if (!$updatedAdmin) {
            return false;
        }

        return $updatedAdmin;
    }
}
