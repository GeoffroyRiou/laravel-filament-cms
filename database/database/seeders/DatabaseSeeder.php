<?php

namespace Database\Seeders;

use App\Enums\PostsStatus;
use App\Enums\UserRoles;
use App\Models\Accueil;
use App\Models\ContactForm;
use App\Models\Settings;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrateur',
            'email' => 'postmaster@imageinfrance.com',
            'password' => bcrypt('P0u2jV9sDtsUfeUVVvt47urQ5'),
            'role' => UserRoles::Admin->value,
        ]);

        Settings::create([
            'facebook' => '',
            'linkedin' => '',
            'x' => '',
            'instagram' => '',
            'telephone' => '',
            'adresse' => '',
            'email' => '',
        ]);

    }
}
