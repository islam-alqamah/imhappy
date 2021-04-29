<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ticket_id' => 1,
                'user_id' => 1,
                'comment' => 'Hello, this is a reply for the ticket ! thanks',
                'created_at' => '2020-10-22 19:25:08',
                'updated_at' => '2020-10-22 19:25:08',
            ),
            1 => 
            array (
                'id' => 2,
                'ticket_id' => 1,
                'user_id' => 1,
                'comment' => 'Great i\'ll look into it and get back tou soon. thanks',
                'created_at' => '2020-10-22 20:47:06',
                'updated_at' => '2020-10-22 20:47:06',
            ),
            2 => 
            array (
                'id' => 3,
                'ticket_id' => 1,
                'user_id' => 1,
                'comment' => 'Hello there !',
                'created_at' => '2020-11-13 17:09:51',
                'updated_at' => '2020-11-13 17:09:51',
            ),
            3 => 
            array (
                'id' => 4,
                'ticket_id' => 6,
                'user_id' => 1,
                'comment' => 'Ticket Closed',
                'created_at' => '2020-11-14 12:31:50',
                'updated_at' => '2020-11-14 12:31:50',
            ),
            4 => 
            array (
                'id' => 5,
                'ticket_id' => 5,
                'user_id' => 1,
                'comment' => 'Hello, just see your ticket, i\'ll check it out.

Great work.',
                'created_at' => '2020-11-14 13:52:32',
                'updated_at' => '2020-11-14 13:52:32',
            ),
            5 => 
            array (
                'id' => 6,
                'ticket_id' => 7,
                'user_id' => 1,
                'comment' => 'Hello,
I\'m here to help you. please send us more details about your problem.',
                'created_at' => '2020-11-14 20:43:36',
                'updated_at' => '2020-11-14 20:43:36',
            ),
        ));
        
        
    }
}