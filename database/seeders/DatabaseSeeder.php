<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dimas Arya Duwipangga',
            'email' => 'aryad2232@gmail.com',
            'NIM' => '2305062',
            'password' => bcrypt('aryad2232@gmail.com'), 
        ]);
        
    }
}
