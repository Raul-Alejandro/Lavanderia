<?php

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
    	$this->call(SucursalTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(WashServiceTableSeeder::class);
        $this->call(IronServiceTableSeeder::class);
        $this->call(DryServiceTableSeeder::class);
    }
}
