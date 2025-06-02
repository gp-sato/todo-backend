<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateAllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->environment('local', 'testing')) {
            $this->command->error('This seeder can only be run in the local environment.');
            return;
        }

        $this->command->info('Truncating tasks and users tables...');

        Schema::disableForeignKeyConstraints();

        DB::table('tasks')->truncate();
        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        $this->command->info('Truncation complete.');
    }
}
