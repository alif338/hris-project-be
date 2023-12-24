<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AppPayroll;
use App\Models\AppPresence;
use App\Models\AppUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AppRoleSeeder::class,
            AppCompanySeeder::class,
            AppUserSeeder::class,
            AppDepartmentSeeder::class
        ]);

        AppUser::factory(150)->create();
        AppPresence::factory(300)->create();
        AppPayroll::factory(300)->create();
    }
}
