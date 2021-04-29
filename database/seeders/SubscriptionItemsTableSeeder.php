<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscription_items')->delete();
        
        \DB::table('subscription_items')->insert(array (
            0 => 
            array (
                'id' => 4,
                'subscription_id' => 1,
                'stripe_id' => 'si_IGLwLoJ8sfy1yq',
                'stripe_plan' => 'price_1GzkSQE68aQoZh4drWylynZH',
                'quantity' => 1,
                'created_at' => '2020-10-24 16:04:48',
                'updated_at' => '2020-10-24 16:04:48',
            ),
            1 => 
            array (
                'id' => 6,
                'subscription_id' => 2,
                'stripe_id' => 'si_IRDlFEalPXyMa5',
                'stripe_plan' => 'Basic_yearlyzpvLhb',
                'quantity' => 1,
                'created_at' => '2020-11-22 16:21:56',
                'updated_at' => '2020-11-22 16:21:56',
            ),
        ));
        
        
    }
}