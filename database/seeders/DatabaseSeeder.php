<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Right;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Project::factory()->count(10)->create();
        User::factory()->count(10)->create();
        ProjectUser::factory()->count(20)->create();

        $this->call([
            //ProjectSeeder::class,
            //UserSeeder::class,
        ]);
    }
}
