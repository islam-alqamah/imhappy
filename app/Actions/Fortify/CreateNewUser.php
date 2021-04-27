<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\TeamSetting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'reg_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => $this->passwordRules(),
        ],[
          'reg_email.unique'=>'This email is already registered'
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['reg_email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
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
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'",
            'personal_team' => true,
            // Create trials period for the new team created
            'trial_ends_at' => $trial_days,
        ]);
        $user->ownedTeams()->save($team);
        $settings = new TeamSetting();
        $settings->team_id = $team->id;
        $settings->company_name = $user->name;
        $settings->logo = 'images\logos\default.png';
        $settings->reporting_email = $user->email;
        $settings->telegram = '-group_id';
        $settings->facebook = '#';
        $settings->youtube = '#';
        $settings->instagram = '#';
        $settings->save();
    }
}
