<?php

use Illuminate\Database\Seeder;

class SucursalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sucursals')->insert([
            'name' => 'Sucursal Uno',
        ]);

        DB::table('sucursals')->insert([
            'name' => 'Sucursal Dos',
        ]);

        DB::table('sucursals')->insert([
            'name' => 'Sucursal Tres',
        ]);
    }
}
