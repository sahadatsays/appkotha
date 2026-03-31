<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => env('SEED_ADMIN_EMAIL', 'admin@appkotha.com')],
            [
                'name' => env('SEED_ADMIN_NAME', 'Admin User'),
                'password' => Hash::make(env('SEED_ADMIN_PASSWORD', 'password')),
                'is_admin' => true,
            ]
        );

        $this->call([SettingsSeeder::class]);

        if (app()->environment(['local', 'testing'])) {
            $this->call([
                FaqSeeder::class,
                ProductSeeder::class,
                ServiceSeeder::class,
                BlogSeeder::class,
                TestimonialSeeder::class,
                CaseStudySeeder::class,
            ]);
        }
    }
}
