<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            "name" => "add post"
        ]);

        Permission::create([
            "name" => "update post"
        ]);

        Permission::create([
            "name" => "update your post"
        ]);

        Permission::create([
            "name" => "delete post"
        ]);

        Permission::create([
            "name" => "delete your post"
        ]);


        $admin = Role::where('name', 'admin')->first();
        $admin->permissions()->attach([1, 2, 3, 4, 5]);

        $user = Role::where('name', 'user')->first();
        $user->permissions()->attach([1, 3, 4]);
    }
}
