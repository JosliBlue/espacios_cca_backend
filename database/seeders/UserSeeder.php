<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'administrador',
                'email' => 'admin@gp.com',
                'password' => bcrypt('adminsito1')
            ],
            [
                'name' => 'Alex Lizano',
                'email' => 'alex@email.com',
                'password' => bcrypt('alex123')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
