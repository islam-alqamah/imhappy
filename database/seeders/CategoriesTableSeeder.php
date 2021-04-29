<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Billing',
                'created_at' => '2020-10-22 19:25:08',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Support',
                'created_at' => '2020-10-22 19:25:08',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sales',
                'created_at' => '2020-10-22 19:25:08',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}