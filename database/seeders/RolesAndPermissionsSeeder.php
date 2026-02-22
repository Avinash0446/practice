<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = ['create-post','edit-post','delete-post','view-post'];
        foreach($permissions as $permission){
            Permission::firstOrCreate(['name'=> $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo(['create-post','edit-post','view-post']);
        $user->givePermissionTo(['view-post']);
    }
}
