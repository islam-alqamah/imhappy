<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('team_user')->delete();
        \DB::table('team_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'team_id' => 2,
                'user_id' => 4,
                'role' => 'editor',
                'created_at' => '2020-12-05 17:03:35',
                'updated_at' => '2020-12-05 16:25:18',
            ),
            1 => 
            array (
                'id' => 2,
                'team_id' => 1,
                'user_id' => 4,
                'role' => 'editor',
                'created_at' => '2020-12-05 17:03:35',
                'updated_at' => '2020-12-05 16:25:18',
            ),
        ));
    }
}