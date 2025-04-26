<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define standard actions
        $actions = ['view', 'view any', 'create', 'update', 'delete', 'restore', 'force delete'];

        // Define models
        $models = ['users', 'posts', 'comments'];

        // Generate permissions dynamically
        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::create(['name' => "{$action} {$model}"]);
            }
        }

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $editorRole = Role::create(['name' => 'editor']);
        $authorRole = Role::create(['name' => 'author']);
        $contributorRole = Role::create(['name' => 'contributor']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all()); // Admin gets all permissions

        $managerRole->givePermissionTo([
            'view any users', 'view users', 'create users', 'update users',
            'view any posts', 'view posts', 'create posts', 'update posts', 'delete posts',
            'view any comments', 'view comments', 'create comments', 'update comments'
        ]);

        $editorRole->givePermissionTo([
            'view any posts', 'view posts', 'create posts', 'update posts', 'delete posts',
            'view any comments', 'view comments', 'update comments'
        ]);

        $authorRole->givePermissionTo([
            'view any posts', 'view posts', 'create posts', 'update posts', 'delete posts',
            'view any comments', 'view comments', 'create comments', 'update comments', 'delete comments'
        ]);

        $contributorRole->givePermissionTo([
            'view any posts', 'view posts', 'create posts',
            'view any comments', 'view comments', 'create comments', 'update comments'
        ]);

        // Create an admin user
        $adminUser = User::create([
            'name' => 'Vin',
            'email' => 'vin@gmail.com',
            'password' => bcrypt('qwerty12345')
        ]);
        $adminUser->assignRole($adminRole);
    }
}
