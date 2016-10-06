<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);
        $roleAdmin = new Role();
        $roleAdmin->name = 'Administrator';
        $roleAdmin->description = 'Full feature administrator and full permission.';
        $roleAdmin->save();
        $admin->roles()->attach($roleAdmin);

        $moderator = User::find(2);
        $roleModerator = new Role();
        $roleModerator->name = 'Moderator';
        $roleModerator->description = 'Moderator just few feature avaiable.';
        $roleModerator->save();
        $moderator->roles()->attach($roleModerator);

        $roleClient = new Role();
        $roleClient->name = 'Client';
        $roleClient->description = 'Client just few feature avaiable.';
        $roleClient->save();
        $client = User::find(3);
        $client->roles()->attach($roleClient);


        $roleUser = new Role();
        $roleUser->name = 'User';
        $roleUser->description = 'User just few feature avaiable.';
        $roleUser->save();
        $user1 = User::find(4);
        $user1->roles()->attach($roleUser);
        $user2 = User::find(5);
        $user2->roles()->attach($roleUser);
    }
}
