<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'status'=>1,
            'roles_id' => 1,
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => bcrypt('password'),
            'status'=>1,
            'roles_id' => 2,
        ]);
    }
}
