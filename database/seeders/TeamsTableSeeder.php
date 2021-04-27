<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teams')->delete();
        
        \DB::table('teams')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'name' => 'Team509',
                'personal_team' => 1,
                'created_at' => '2020-10-12 23:56:45',
                'updated_at' => '2020-11-22 21:14:12',
                'stripe_id' => 'cus_ICBqY12GBbaoo7',
                'card_brand' => 'mastercard',
                'card_last_four' => '4444',
                'trial_ends_at' => '2020-10-22 23:56:45',
                'trial_expiring_mail_sent_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'name' => 'Other team',
                'personal_team' => 0,
                'created_at' => '2020-10-14 19:13:35',
                'updated_at' => '2020-11-22 14:11:05',
                'stripe_id' => 'cus_IRBeXBAHjqVIQ4',
                'card_brand' => 'mastercard',
                'card_last_four' => '5454',
                'trial_ends_at' => '2020-10-22 23:56:45',
                'trial_expiring_mail_sent_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 4,
                'name' => 'Nouela\'s Team',
                'personal_team' => 1,
                'created_at' => '2020-11-14 17:03:35',
                'updated_at' => '2020-11-14 17:03:35',
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => '2020-11-24 17:03:35',
                'trial_expiring_mail_sent_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'name' => 'Test team',
                'personal_team' => 0,
                'created_at' => '2020-11-22 13:48:11',
                'updated_at' => '2020-11-22 16:37:10',
                'stripe_id' => 'cus_IRBJpfMJMNDFdC',
                'card_brand' => 'mastercard',
                'card_last_four' => '5454',
                'trial_ends_at' => NULL,
                'trial_expiring_mail_sent_at' => NULL,
            ),
        ));
        
        
    }
}