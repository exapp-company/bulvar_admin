<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::query()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'role' => UserRoles::get('admin'),
            'email_verified_at' => now(),
        ]);

        User::query()->create([
            'name' => 'content',
            'email' => 'content@content.com',
            'password' => 'admin',
            'role' => UserRoles::get('content'),
            'email_verified_at' => now(),

        ]);

        User::query()->create([
            'name' => 'seo',
            'email' => 'seo@seo.com',
            'password' => 'seo',
            'role' => UserRoles::get('seo'),
            'email_verified_at' => now(),
        ]);
    }
}
