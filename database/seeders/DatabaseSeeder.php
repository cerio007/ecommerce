<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create([
        //     'name' => 'Joshua King',
        //     'email' => 'joshuaking@gmail.com',
        //     'password'=> bcrypt(''),
        // ]);
        Product::factory(10)->create();
        User::factory(10)->create();
    }
}
