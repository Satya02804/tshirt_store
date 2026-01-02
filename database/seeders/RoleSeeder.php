<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Product permissions
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',

            // User permissions
            'view-users',
            'delete-users',

            //assign role
            'updatePermission',
            // Dashboard permissions
            'view-dashboard',
            'view-analytics',
            // Order permissions
            'view-orders',
            'view-earnings',
            // Shopping permissions
            'add-to-cart',
            'checkout',
            'payment',
            'place-orders',
        ];


        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Create Super Admin Role
        $superAdmin = Role::findOrCreate('super-admin');
        $superAdmin->givePermissionTo(Permission::all());

        // Create Admin Role
        $admin = Role::findOrCreate('admin');
        $admin->givePermissionTo([
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',
            'view-users',
            'view-orders',
            'view-earnings',
            'view-dashboard',
            'view-analytics',
            'add-to-cart',
            'checkout',
            'payment',
            'place-orders',

        ]);

        // Create User Role with shopping permissions
        $user = Role::findOrCreate('user');
        $user->givePermissionTo([
            'add-to-cart',
            'checkout',
            'payment',
            'place-orders',

        ]);


        // Create Super Admin User
        $superAdminUser = User::firstOrCreate(
            ['email' => 'patelsatya2804@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('satya'),
            ]
        );

        // Assign super-admin role
        if (!$superAdminUser->hasRole('super-admin')) {
            $superAdminUser->assignRole('super-admin');
        }

        // Assign 'user' role to all other existing users
        $otherUsers = User::where('email', '!=', 'patelsatya2804@gmail.com')->get();
        foreach ($otherUsers as $otherUser) {
            if (!$otherUser->hasAnyRole(['super-admin', 'admin', 'user'])) {
                $otherUser->assignRole('user');
            }
        }
    }
}
