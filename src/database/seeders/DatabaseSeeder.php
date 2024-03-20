<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Otp;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->has(
            Role::factory()->has(
                Permission::factory()
            )
        )->create();
        Company::factory()->create();
    }
}
