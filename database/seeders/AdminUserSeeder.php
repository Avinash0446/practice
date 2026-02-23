<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::UpdateOrCreate([
            'email' => 'admin@yopmail.com'
        ], [
            'name' => 'Admin User',
            'password' => bcrypt(value: 'password'),
            'status' => 'active'
        ]);
        $admin->assignRole('admin');
    }
}
