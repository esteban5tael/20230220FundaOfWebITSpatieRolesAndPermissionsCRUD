<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Roles iniciales */
        $superAdmin=Role::create(['name' => 'Super-Admin']);
        $admin=Role::create(['name' => 'Admin']);
        $user=Role::create(['name' => 'User']);
        $staff=Role::create(['name' => 'Staff']);
        /* Roles iniciales */

        /* Permisos iniciales */
        Permission::create(['name' => 'Create User'])->syncRoles( [$superAdmin,$admin] );
        Permission::create(['name' => 'View User'])->syncRoles( [$superAdmin,$admin,$user,$staff] );
        Permission::create(['name' => 'Edit User'])->syncRoles( [$superAdmin,$admin] );
        Permission::create(['name' => 'Delete User'])->syncRoles( [$superAdmin,] );

        Permission::create(['name' => 'Create Role'])->syncRoles( [$superAdmin,$admin] );
        Permission::create(['name' => 'View Role'])->syncRoles( [$superAdmin,$admin,$user,$staff] );
        Permission::create(['name' => 'Edit Role'])->syncRoles( [$superAdmin,$admin] );
        Permission::create(['name' => 'Delete Role'])->syncRoles( [$superAdmin,] );

        Permission::create(['name' => 'Create Permission'])->syncRoles( [$superAdmin,$admin] );
        Permission::create(['name' => 'View Permission'])->syncRoles( [$superAdmin,$admin,$user,$staff] );
        Permission::create(['name' => 'Edit Permission'])->syncRoles( [$superAdmin,$admin] );
        Permission::create(['name' => 'Delete Permission'])->syncRoles( [$superAdmin,] );
        /* Permisos iniciales */



        // superadministrador
        User::create(['name' => 'Super Admin','email' => 'superadmin@superadmin.com','password' => Hash::make('12345678')])->assignRole($superAdmin);
        // administrador
        User::create(['name' => 'Admin','email' => 'admin@admin.com','password' => Hash::make('12345678')])->assignRole($admin);
        // usuario
        User::create(['name' => 'User','email' => 'user@user.com','password' => Hash::make('12345678'),])->assignRole($user);
        // Staff
        User::create(['name' => 'Staff','email' => 'staff@staff.com','password' => Hash::make('12345678'),])->assignRole($staff);
    }
}
