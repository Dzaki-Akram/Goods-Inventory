<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar role
        $roles = ['admin', 'user'];

        // Daftar permission
        $permissions = [
            'create product',
            'edit product',
            'delete product',
            'view product',
        ];

        // Buat role jika belum ada
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Buat permission jika belum ada
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permission ke role
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        if ($adminRole) {
            $adminRole->syncPermissions(['create product', 'edit product', 'delete product']);
        }

        if ($userRole) {
            $userRole->syncPermissions(['view product']);
        }
    }
}
