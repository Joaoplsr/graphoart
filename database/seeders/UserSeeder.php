<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enum\RoleEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => RoleEnum::ADMIN->value,
            'password' => bcrypt(env('USERSEED_PASSWORD')),
        ]);
        User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'role_id' => RoleEnum::EDITOR->value,
            'password' => bcrypt(env('USERSEED_PASSWORD')),
        ]);
        User::create([
            'name' => 'Editor 2',
            'email' => 'editor2@gmail.com',
            'role_id' => RoleEnum::EDITOR->value,
            'password' => bcrypt(env('USERSEED_PASSWORD')),
        ]);
        User::create([
            'name' => 'Reviewer',
            'email' => 'reviewer@gmail.com',
            'role_id' => RoleEnum::REVIEWER->value,
            'password' => bcrypt(env('USERSEED_PASSWORD')),
        ]);
    }
}
