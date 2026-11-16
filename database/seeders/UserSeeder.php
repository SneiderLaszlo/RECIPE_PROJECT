<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
            ['name' => 'Admin',      'email' => 'admin@example.com',     'role' => 'admin'],
            ['name' => 'Moderátor',  'email' => 'moderator@example.com', 'role' => 'moderator'],
            ['name' => 'LACI TESZT', 'email' => 'user@example.com',      'role' => 'user'],      
        ];
 
        foreach ($users as $data) {
            $role = Role::where('name', $data['role'])->first();
 
            User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('1234'),
                'role_id'  => $role->id,
                'email_verified_at' => now(),
            ]);
        }
    }
}
