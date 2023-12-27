<?php

namespace Database\Seeders;

use App\Models\AppCompany;
use App\Models\AppDepartment;
use App\Models\AppUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AppDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppDepartment::insert([
            // First Company
            [
                'companyid' => AppCompany::all()->first()->companyid,
                'departmentname' => 'Human Resources (HR)',
                'departmentdesc' => 'Responsible for personnel management, recruitment, training, and employee relations.'
            ],
            [
                'companyid' => AppCompany::all()->first()->companyid,
                'departmentname' => 'Finance',
                'departmentdesc' => 'Handles financial transactions, budgeting, and financial reporting.'
            ],
            [
                'companyid' => AppCompany::all()->first()->companyid,
                'departmentname' => 'Information Technology (IT)',
                'departmentdesc' => 'Manages technology infrastructure, software development, and IT support.'
            ],

            // Second Company
            [
                'companyid' => AppCompany::all()->last()->companyid,
                'departmentname' => 'Human Resources (HR)',
                'departmentdesc' => 'Responsible for personnel management, recruitment, training, and employee relations.'
            ],
            [
                'companyid' => AppCompany::all()->last()->companyid,
                'departmentname' => 'Finance',
                'departmentdesc' => 'Handles financial transactions, budgeting, and financial reporting.'
            ],
            [
                'companyid' => AppCompany::all()->last()->companyid,
                'departmentname' => 'Marketing',
                'departmentdesc' => "Plans and executes marketing strategies to promote the organization's products or services."
            ],
            [
                'companyid' => AppCompany::all()->last()->companyid,
                'departmentname' => 'Research and Development (R&D)',
                'departmentdesc' => "Conducts research and develops new products or services."
            ],
        ]);

        $companies = AppCompany::all();
        foreach ($companies as $idx => $company) {
            foreach ($company->departments()->get() as $department) {
                AppUser::insert([
                    [
                        'email' => 'admindept' . explode('-', $department->departmentid)[0] . '@gmail.com',
                        'password' => Hash::make('test123456', ['memory' => 1024, 'time' => 2, 'threads' => 2]),
                        'rolecode' => 'admin_dept',
                        'address' => fake()->streetAddress(),
                        'fullname' => 'Admin Dept. '.$department->departmentname,
                        'dateofbirth' => fake()->date(),
                        'phonenumber' => fake()->phoneNumber(),
                        'companycode' => $company->companycode,
                        'departmentid' => $department->departmentid
                    ]
                ]);
            }
        }
    }
}
