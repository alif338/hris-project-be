<?php

namespace Database\Factories;

use App\Models\AppUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AppPresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $employee = AppUser::where('rolecode', 'employee')->get()->random(1)->first();
        $checkIn = fake()->time();
        $checkOut = fake()->time();
        return [
            'userid' => $employee->userid,
            'presencedate' => fake()->dateTimeBetween('-3 months')->format('Y-m-d'),
            'checkintime' => min($checkIn, $checkOut),
            'checkouttime' => max($checkIn, $checkOut)
        ];
    }
}
