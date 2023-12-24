<?php

namespace Database\Seeders;

use App\Models\AppCompany;
use Illuminate\Database\Seeder;

class AppCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1 = fake()->company();
        $companyMail1 = fake()->companyEmail();
        $company2 = fake()->company();
        $companyMail2 = fake()->companyEmail();
        AppCompany::insert([
            [
                'companycode' => md5(strtolower($company1)),
                'companyname' => $company1,
                'about' => fake()->sentence(),
                'companymail' => $companyMail1,
                'address' => fake()->streetAddress(),
                'contactnumber' => fake()->phoneNumber()
            ],
            [
                'companycode' => md5(strtolower($company2)),
                'companyname' => $company2,
                'about' => fake()->sentence(),
                'companymail' => $companyMail2,
                'address' => fake()->streetAddress(),
                'contactnumber' => fake()->phoneNumber()
            ]
        ]);
    }
}
