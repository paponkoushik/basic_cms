<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->insert([
            [
                'name' => 'Koushik',
                'email' => 'koushik@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Papon',
                'email' => 'Papon@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
