<?php

namespace Database\Seeders;

use App\Models\AppCompany;
use App\Models\AppDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
