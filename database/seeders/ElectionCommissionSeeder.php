<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ElectionCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'election@gmail.com')->exists()) {
            User::create([
                'name' => 'Election Commission',
                'email' => 'election@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'election',
            ]);
        }
    }
}
