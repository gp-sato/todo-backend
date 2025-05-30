<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(10)->get();

        foreach ($users as $user) {
            $taskCount = rand(0, 5);

            Task::factory()
                ->count($taskCount)
                ->for($user)
                ->create();
        }
    }
}
