<?php

namespace Database\Seeders;


use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {

        // Add the master administrator, user id of 1
        $user1 = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);
        $this->createTeam($user1);

        if (app()->environment(['local', 'testing'])) {
            $user2 = User::create([
                'name' => 'Test User',
                'email' => 'user@user.com',
                'password' => 'secret',
                'email_verified_at' => now(),
                'active' => true,
            ]);
            $this->createTeam($user2);
        }
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $trial_days = null;
        if (config('saas.trial_days') !== null) {
            $trial_days = now()->addDays(config('saas.trial_days'));
        }

        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
            // Create trials period for the new team created
            'trial_ends_at' => $trial_days,
        ]));
    }
}
