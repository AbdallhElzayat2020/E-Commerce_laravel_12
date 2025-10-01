<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\RoleRepository;

class RoleService
{
    protected RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function getRoles()
    {
        return $this->roleRepository->getRoles();
    }

    public function getRoleById($id)
    {
        return $this->roleRepository->getRoleById($id);
    }

    public function createRole($request)
    {
        return $this->roleRepository->createRole($request);
    }

    public function editRole($id, $request)
    {
        $role = $this->roleRepository->editRole($id, $request);
        if (!$role) {
            abort(404);
        }
        return $role;
    }

    public function delete($id)
    {
        $role = $this->roleRepository->getRoleById($id);

        if (!$role) {
            return false;
        }

        if ($role->admins()->count() > 0) {
            return false;
        }

        return $this->roleRepository->delete($id);
    }

    public function updateStatus(int $id, string $status)
    {
        $role = $this->roleRepository->updateStatus($id, $status);

        if (!$role) {
            abort(404);
        }
        return $role;
    }
}
