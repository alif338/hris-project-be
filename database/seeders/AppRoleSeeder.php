<?php

namespace Database\Seeders;

use App\Models\AppRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppRole::insert([
            ['rolecode' => 'superadmin', 'rolename' => 'Super Admin'],
            ['rolecode' => 'admin', 'rolename' => 'Admin Company'],
            ['rolecode' => 'admin_dept', 'rolename' => 'Admin Department'],
            ['rolecode' => 'employee', 'rolename' => 'Employee']
        ]);
    }
}
