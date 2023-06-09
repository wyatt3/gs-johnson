<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectsTableSeeder::class);
        $this->call(ProjectCategoriesTableSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
