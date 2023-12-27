<?php

namespace Database\Seeders;

use App\Models\AppCompany;
use App\Models\AppUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert SuperAdmin
        DB::table('app_users')->insert([
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('test123456', ['memory' => 1024, 'time' => 2, 'threads' => 2]),
            'rolecode' => 'superadmin',
            'fullname' => 'Super Admin',
            'dateofbirth' => '1970-01-01',
        ]);

        // Insert 2 admins (for Company1 & Company2)
        AppUser::insert([
            [
                'email' => 'admincomp1@gmail.com',
                'password' => Hash::make('test123456', ['memory' => 1024, 'time' => 2, 'threads' => 2]),
                'rolecode' => 'admin',
                'fullname' => 'Admin Company 1',
                'dateofbirth' => '1980-01-01',
                'companycode' => AppCompany::all()->first()->companycode,
                'phonenumber' => '+1 23456789',
                'address' => 'test address1'
            ],
            [
                'email' => 'admincomp2@gmail.com',
                'password' => Hash::make('test123456', ['memory' => 1024, 'time' => 2, 'threads' => 2]),
                'rolecode' => 'admin',
                'fullname' => 'Admin Company 2',
                'dateofbirth' => '1990-01-01',
                'companycode' => AppCompany::all()->last()->companycode,
                'phonenumber' => '+62 23456789',
                'address' => 'test address2'
            ]
        ]);
    }
}
