<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        // Insert sample department data
        DB::table('departments')->insert([
            ['slug' => 'central', 'name' => 'Central Department'],
            ['slug' => 'multimedia', 'name' => 'Multimedia Department'],
            ['slug' => 'publication', 'name' => 'Publication Department'],
            ['slug' => 'development', 'name' => 'Development Department'],
            // Add more departments if needed
        ]);
    }
}
