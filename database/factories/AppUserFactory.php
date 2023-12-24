<?php

namespace Database\Factories;

use App\Models\AppCompany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AppUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = AppCompany::all()->random(1)->first();
        $department = $company->departments()->get()->random(1)->first();
        return [
            'email' => fake()->freeEmail(),
            'password' => Hash::make('employee123', ['memory' => 1024, 'time' => 2, 'threads' => 2]),
            'rolecode' => 'employee',
            'fullname' => fake()->name(),
            'dateofbirth' => fake()->date(),
            'departmentid' => $department->departmentid,
            'companycode' => $company->companycode,
            'phonenumber' => fake()->phoneNumber(),
            'address' => fake()->streetAddress()
        ];
    }
}
