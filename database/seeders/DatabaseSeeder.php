<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TaskSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            TaskSeeder::class
        ]);
    }
}
