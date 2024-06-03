<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => '1',
                'name' => "root",
                'guard_name' => "web",
            ],
            [
                'id' => '2',
                'name' => "admin",
                'guard_name' => "web",
            ],
            [
                'id' => '3',
                'name' => "office",
                'guard_name' => "web",
            ],
            [
                'id' => '4',
                'name' => "faculty",
                'guard_name' => "web",
            ],
          
           
        ];

        DB::table('roles')->insert($roles);
    }
}
