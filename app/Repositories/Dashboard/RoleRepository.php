<?php

namespace App\Repositories\Dashboard;

use App\Models\Role;

class RoleRepository
{

    public function getRoles()
    {
        return Role::select('id', 'name', 'status')
            ->active()
            ->paginate(9)->withQueryString();
    }

    public function createRole($request)
    {
        return Role::create([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar']
            ],
            'permissions' => json_encode($request->permissions),
            'status' => $request->status,
        ]);
    }

    public function getRoleById(int $id)
    {
        return Role::findOrFail($id);
    }

    public function editRole(int $id, $request)
    {
        $role = self::getRoleById($id);
        $role->update([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar']
            ],
            'permissions' => json_encode($request->permissions),
            'status' => $request->status,
        ]);
        return $role;
    }

    public function delete($id)
    {
        $role = self::getRoleById($id);
        if (!$role) {
            return false;
        }

        $role->delete();
        return true;
    }

    public function updateStatus($id, $status)
    {
        $role = self::getRoleById($id);
        if (!$role) {
            return false;
        }

        $role->update(['status' => $status]);
        return $role->fresh(); // Return updated role
    }
}
