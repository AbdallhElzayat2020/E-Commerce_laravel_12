<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
