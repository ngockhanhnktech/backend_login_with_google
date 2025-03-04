<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'View Designs', 'route' => 'designs.index', 'roles_id' => 2]); // User
        Permission::create(['name' => 'Create Design', 'route' => 'designs.create', 'roles_id' => 1]); // Admin
        Permission::create(['name' => 'Update Design', 'route' => 'designs.update', 'roles_id' => 1]); // Admin
    }
}
