<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'テストユーザー',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(9)->create();
    }
}
