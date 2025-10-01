<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [];
        foreach (config('permissions_en') as $key => $value) {
            $permissions[] = $key;
        }

        Role::create([
            'name' => 'Super Admin',
            'permissions' => json_encode($permissions),
            'status' => 'active',
        ]);
    }
}
