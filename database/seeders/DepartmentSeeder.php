<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'code' => '001',
            'name' => 'AT&T',
            'description' => 'the American Telephone and Telegraph Company',
        ]);
        Department::create([
            'code' => '002',
            'name' => 'DC',
            'description' => 'Direct Client',
        ]);
    }
}
