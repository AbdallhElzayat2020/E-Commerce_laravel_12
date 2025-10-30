<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsersForDataTable()
    {
        $users = $this->userRepository->getAll();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('status', function ($user) {
                return view('dashboard.pages.users.datatables.status', compact('user'))->render();
            })
            ->addColumn('country', function ($user) {
                return $user->country->name;
            })
            ->addColumn('governorate', function ($user) {
                return $user->governorate->name;
            })
            ->addColumn('city', function ($user) {
                return $user->city->name;
            })
            ->addColumn('num_of_orders', function ($user) {
                return $user->orders()->count() > 0 ? $user->orders()->count() : __('dashboard.not_found');
            })
            ->addColumn('email_verified_at', function ($user) {
                return $user->email_verified_at;
            })
            ->addColumn('action', function ($user) {
                return view('dashboard.pages.users.datatables.actions', compact('user'))->render();
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function createUser($data)
    {
        return $this->userRepository->createUser($data);
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) {
            return false;
        }
        return $this->userRepository->deleteUser($user);
    }

    public function changeStatus($id)
    {
        $user = $this->userRepository->getUser($id);
        if (!$user) {
            return false;
        }
        // Flip between 'active' and 'inactive'
        $status = $user->status === 'active' ? 'inactive' : 'active';
        return $this->userRepository->changeStatus($user, $status);
    }
}
