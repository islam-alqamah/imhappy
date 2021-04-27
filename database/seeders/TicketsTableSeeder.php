<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tickets')->delete();
        
        \DB::table('tickets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'category_id' => 2,
                'ticket_id' => 'VUHCNBETAV',
                'title' => 'Test subscription ticket',
                'priority' => 'medium',
                'message' => 'This is a test ticket',
                'status' => 'Open',
                'created_at' => '2020-10-22 16:02:10',
                'updated_at' => '2020-11-13 17:09:51',
                'team_id' => 1,
            ),
            1 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'category_id' => 2,
                'ticket_id' => 'FVSHISFGSZ',
                'title' => 'Test subscription ticket',
                'priority' => 'high',
                'message' => 'Hello there,
Need support for your app.
thx',
                'status' => 'Open',
                'created_at' => '2020-11-14 12:22:36',
                'updated_at' => '2020-11-14 13:52:32',
                'team_id' => 1,
            ),
            2 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'category_id' => 2,
                'ticket_id' => 'CEEBWYJGSK',
                'title' => 'Test subscription ticket',
                'priority' => 'high',
                'message' => 'Hello there,
Need support for your app.
thx',
                'status' => 'Closed',
                'created_at' => '2020-11-14 12:23:25',
                'updated_at' => '2020-11-14 12:31:50',
                'team_id' => 1,
            ),
            3 => 
            array (
                'id' => 7,
                'user_id' => 4,
                'category_id' => 2,
                'ticket_id' => 'A6XJ5VK521',
                'title' => 'Full stack Developer',
                'priority' => 'medium',
                'message' => 'Hello there, I need your support.',
                'status' => 'Open',
                'created_at' => '2020-11-14 20:40:27',
                'updated_at' => '2020-11-14 20:43:36',
                'team_id' => 4,
            ),
        ));
        
        
    }
}