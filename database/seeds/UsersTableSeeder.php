<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "admin123",
            "email" => "admin@gmail.com",
            "password" => bcrypt('admin123'),
            "role_id" => 1
        ]);

        User::create([
            "name" => "Juan",
            "email" => "juandev.net@gmail.com",
            "password" => bcrypt('juan123'),
            "role_id" => 2
        ]);
    }
}
