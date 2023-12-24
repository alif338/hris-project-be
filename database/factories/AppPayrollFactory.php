<?php

namespace Database\Factories;

use App\Models\AppUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AppPayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employee = AppUser::where('rolecode', 'employee')->get()->random(1)->first();
        
        return [
            'userid' => $employee->userid,
            'payrolldate' => fake()->dateTimeBetween('-3 months')->format('Y-m-d'),
            'purposes' => fake()->sentence(),
            'amount' => fake()->numberBetween(100000, 10000000),
            'bank_account' => fake()->creditCardType(),
            'currency' => fake()->currencyCode(),
            'status' => fake()->boolean()
        ];
    }
}
