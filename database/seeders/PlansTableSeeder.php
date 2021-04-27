<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('plans')->delete();
        
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Basic Plan',
                'slug' => 'basic-plan',
                'stripe_id' => 'price_1GzkRLE68aQoZh4da9t4H26p',
                'interval' => 'month',
                'price' => '10.00',
                'active' => 1,
                'teams_limit' => 3,
                'trial_period_days' => NULL,
                'created_at' => '2020-10-18 15:27:31',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Pro Plan',
                'slug' => 'pro-plan',
                'stripe_id' => 'price_1GzkSQE68aQoZh4drWylynZH',
                'interval' => 'month',
                'price' => '20.00',
                'active' => 1,
                'teams_limit' => 2,
                'trial_period_days' => NULL,
                'created_at' => '2020-10-18 15:27:31',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Bronz',
                'slug' => 'bronz-plan',
                'stripe_id' => 'price_1GzkSQE68aQoZh4drWylyn',
                'interval' => 'month',
                'price' => '40.00',
                'active' => 1,
                'teams_limit' => 2,
                'trial_period_days' => NULL,
                'created_at' => '2020-10-18 15:27:31',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'title' => 'Yearly pro',
                'slug' => 'yearly-pro',
                'stripe_id' => 'Yearly_pro',
                'interval' => 'year',
                'price' => '200.00',
                'active' => 1,
                'teams_limit' => 10,
                'trial_period_days' => 0,
                'created_at' => '2020-10-23 23:31:44',
                'updated_at' => '2020-10-23 23:31:44',
            ),
            4 => 
            array (
                'id' => 6,
                'title' => 'Yearly bronz',
                'slug' => 'yearly-bronz',
                'stripe_id' => 'plan_IG6APycJXxzThI',
                'interval' => 'year',
                'price' => '400.00',
                'active' => 1,
                'teams_limit' => 20,
                'trial_period_days' => 0,
                'created_at' => '2020-10-23 23:46:33',
                'updated_at' => '2020-10-23 23:46:33',
            ),
            5 => 
            array (
                'id' => 7,
                'title' => 'Basic yearly',
                'slug' => 'basic-yearly',
                'stripe_id' => 'Basic_yearlyzpvLhb',
                'interval' => 'year',
                'price' => '100.00',
                'active' => 1,
                'teams_limit' => 6,
                'trial_period_days' => NULL,
                'created_at' => '2020-11-22 16:18:39',
                'updated_at' => '2020-11-22 16:18:39',
            ),
        ));
        
        
    }
}