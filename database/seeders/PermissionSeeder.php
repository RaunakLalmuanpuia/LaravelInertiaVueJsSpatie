<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            

            ['name' => "role-menu",'guard_name' => 'web'],
            ['name' => "role-add",'guard_name' => 'web'],
            ['name' => "role-edit",'guard_name' => 'web'],
            ['name' => "role-delete",'guard_name' => 'web'],
            ['name' => "role-assign",'guard_name' => 'web'],
          
        ];

        DB::table('permissions')->insert($permissions);
    }
}
