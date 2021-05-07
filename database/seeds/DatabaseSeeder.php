<?php

use Database\Seeders\users;
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
        $this->call(users::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TopMGTPermissionsTableSeeder::class);

        // $this->call(UserSeeder::class);
    }
}
