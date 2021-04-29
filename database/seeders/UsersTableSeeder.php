<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'email_verified_at' => '2020-11-14 20:42:47',
                'password' => '$2y$12$.pxwg0ZR8C0pVqLLeMzJYu7/ynp/4W.zQNcpFcOuJdBUKkVXrhEGy',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'remember_token' => '2blPLIUy3IK8nSPVnYPhVx0qAzmgG2HVlAeYlp2SmWQ7oE4XSNmYJEmGVauh',
                'timezone' => 'America/New_York',
                'current_team_id' => 2,
                'profile_photo_path' => NULL,
                'created_at' => '2020-10-12 23:56:45',
                'updated_at' => '2020-11-24 11:49:12',
                'last_login_at' => '2020-11-14',
                'last_login_ip' => NULL,
                'mobile' => '7862522284',
                'mobile_verified' => 0,
                'active' => 1,
                'gender' => 'male',
                'country' => NULL,
                'city' => NULL,
                'address' => NULL,
                'zip' => NULL,
                'locale' => 'fr',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'User test',
                'email' => 'user@user.com',
                'email_verified_at' => '2020-11-14 17:06:28',
                'password' => '$2y$12$OLK200dyGstgFMTwX4CB7.xnJFLJL91B2fRxneIeMUxt52jLRT4za ',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'remember_token' => NULL,
                'timezone' => 'America/New_York',
                'current_team_id' => 4,
                'profile_photo_path' => NULL,
                'created_at' => '2020-11-14 17:03:35',
                'updated_at' => '2020-11-23 16:25:18',
                'last_login_at' => '2020-11-14',
                'last_login_ip' => NULL,
                'mobile' => NULL,
                'mobile_verified' => 0,
                'active' => 1,
                'gender' => NULL,
                'country' => NULL,
                'city' => NULL,
                'address' => NULL,
                'zip' => NULL,
                'locale' => 'en',
            ),
        ));
        
    }
}