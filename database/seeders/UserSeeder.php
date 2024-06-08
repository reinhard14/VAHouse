<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Administrator;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(5000)->create();

        User::create([
            'name' => 'developer super-admin',
            'lastname' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'role_id' => 1
        ]);
    }
}
