<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call([
            DemoDataSeeder::class,
        ]);*/
        User::create([
            'email' => 'fabianeternis@gmail.com',
            'role' => 'admin',
        ]);
    }
}