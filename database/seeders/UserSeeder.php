<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name'              => "Root",
            'role'              => "root", // [root,admin,student,faculty,office}
            'email'             => 'root@mail.com',
            'password'          => Hash::make('password'),
            'status'            => 'active',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);
    
    $user->assignRole('root');
    }
}
