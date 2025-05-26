<?php

namespace Database\Seeders;

use App\Models\Objective;
use App\Models\Permission;
use App\Models\Room;
use App\Models\User;
use App\Models\Game;
use App\Models\UserPermission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::GeneratePermissions();

        $admin = User::create([
            'email' => config('app.admin_email'),
            'password' => bcrypt(config('app.admin_pass')),
            'name' => 'Admin',
        ]);

        UserPermission::create([
            'user_id' => $admin->id,
            'permission_id' => 1
        ]);
    }
}
