<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('coupons')->delete();
        
        \DB::table('coupons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test coupon',
                'gateway_id' => '20-OFF',
                'percent_off' => 20.0,
                'duration' => 'once',
                'duration_in_months' => NULL,
                'currency' => NULL,
                'created_at' => '2020-10-18 21:04:34',
                'updated_at' => '2020-10-18 21:04:34',
            ),
        ));
        
        
    }
}