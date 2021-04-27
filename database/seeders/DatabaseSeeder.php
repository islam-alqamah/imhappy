<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(PlansTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        // $this->call(CommentsTableSeeder::class);
        // $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(TeamUserTableSeeder::class);
        // $this->call(TicketsTableSeeder::class);
        // $this->call(SubscriptionsTableSeeder::class);
        // $this->call(SubscriptionItemsTableSeeder::class);
    }
}
