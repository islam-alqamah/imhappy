<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonalAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('personal_access_tokens')->delete();
        
        \DB::table('personal_access_tokens')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 1,
                'name' => 'mmac-token',
                'token' => 'fa5bfdc8044429076e440ec4d0c660845949d3656b56cd56b33fa02960b6fbb2',
                'abilities' => '["read","delete","update","create"]',
                'last_used_at' => NULL,
                'created_at' => '2020-10-21 23:09:58',
                'updated_at' => '2020-10-21 23:09:58',
            ),
            1 => 
            array (
                'id' => 2,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 1,
                'name' => 'test token',
                'token' => '47997af915f285ad8e43a073ff8436b05cc8e6fda3e5ef72406928ff53b257b7',
                'abilities' => '["read","create"]',
                'last_used_at' => NULL,
                'created_at' => '2020-11-20 16:58:47',
                'updated_at' => '2020-11-20 16:58:47',
            ),
        ));
        
        
    }
}