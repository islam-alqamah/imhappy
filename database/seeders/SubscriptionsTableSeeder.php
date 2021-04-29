<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscriptions')->delete();
        
        \DB::table('subscriptions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'team_id' => 1,
                'name' => 'default',
                'stripe_id' => 'sub_ICBqFkjw5aZoRj',
                'stripe_status' => 'active',
                'stripe_plan' => 'price_1GzkSQE68aQoZh4drWylynZH',
                'quantity' => 1,
                'trial_ends_at' => NULL,
                'ends_at' => NULL,
                'created_at' => '2020-10-13 13:22:29',
                'updated_at' => '2020-11-14 16:43:16',
            ),
            1 => 
            array (
                'id' => 2,
                'team_id' => 2,
                'name' => 'default',
                'stripe_id' => 'sub_IRBhXerg1DzL5e',
                'stripe_status' => 'active',
                'stripe_plan' => 'Basic_yearlyzpvLhb',
                'quantity' => 1,
                'trial_ends_at' => NULL,
                'ends_at' => NULL,
                'created_at' => '2020-11-22 14:14:10',
                'updated_at' => '2020-11-22 16:21:56',
            ),
        ));
        
        
    }
}