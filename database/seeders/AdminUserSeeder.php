<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin iCommits',
            'email' => 'admin@icommits.com',
            'password' => bcrypt('rahasia123')
        ]);
    }
}