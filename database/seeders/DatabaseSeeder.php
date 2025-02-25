<?php

namespace Database\Seeders;

use App\OCms\Enums\PostsStatus;
use App\OCms\Enums\UserRoles;
use App\OCms\Models\Accueil;
use App\OCms\Models\ContactForm;
use App\OCms\Models\Settings;
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
            'email' => 'geoffroy.riou.pro@gmail.com',
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
