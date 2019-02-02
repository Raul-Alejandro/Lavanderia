<?php

use Illuminate\Database\Seeder;

class IronServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('iron_services')->insert([
            'code' => '0001',
            'name' => 'Camisas',
            'cost' => 9,
            'promotion_cost' => 8,
       	]);

       	DB::table('iron_services')->insert([
            'code' => '0002',
            'name' => 'Pantalones',
            'cost' => 9,
            'promotion_cost' => 8,
       	]);

        DB::table('iron_services')->insert([
            'code' => '0003',
            'name' => 'Vestido Corto',
            'cost' => 30,
        ]);

        DB::table('iron_services')->insert([
            'code' => '0003',
            'name' => 'Vestido Largo',
            'cost' => 30,
        ]);
    }
}
