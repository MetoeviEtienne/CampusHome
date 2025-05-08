<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        public function run()
        {
            User::create([
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => bcrypt('password123'),
                'role' => 'student',
                'ville' => 'Cotonou',
            ]);
    }
}
