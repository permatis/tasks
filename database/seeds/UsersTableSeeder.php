<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'  => 'Administrator',
                'email' => 'admin@example.com',
                'password'  => 'admin123',
                'confirmed' => 1
            ],
            [
                'name'  => 'Test Moderator',
                'email' => 'moderator@example.com',
                'password' => 'moderator123',
                'confirmed' => 1
            ],
            [
                'name'  => 'Client Example',
                'email' => 'client@example.com',
                'password' => 'client123',
                'confirmed' => 1
            ],
            [
                'name'  => 'User1',
                'email' => 'user1@example.com',
                'password' => 'user123',
                'confirmed' => 1
            ],
            [
                'name'  => 'User2',
                'email' => 'user2@example.com',
                'password' => 'user123',
                'confirmed' => 1
            ]
        ];

        foreach($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
