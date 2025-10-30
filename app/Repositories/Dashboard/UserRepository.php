<?php

namespace App\Repositories\Dashboard;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::with(['city', 'governorate', 'country'])->latest();
    }

    public function getUser($id)
    {
        return User::find($id);
    }

    public function createUser($data)
    {
        return User::create($data);
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }

    public function changeStatus($user, $status)
    {
        return $user->update([
            'status' => $status,
        ]);
    }
}
