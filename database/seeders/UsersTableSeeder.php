<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([       
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([       
            'id' => 2,
            'name' => 'leader',
            'email' => 'leader@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'role' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([       
            'id' => 3,
            'name' => 'user',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
