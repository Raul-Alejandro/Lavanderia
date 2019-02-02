<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
                'name' => 'Super Administrador',
                'email' => 'super@hotmail.com',
                'password' => bcrypt('super123456'),
                'type' => 'SUPER',
        ]);

        DB::table('users')->insert([
                'name' => 'Empleado Uno',
                'email' => 'empleado_uno@hotmail.com',
                'password' => bcrypt('empleado1'),
                'type' => 'EMPLEADO',
                'status' => 'ACTIVO',
                'idSucursal' => 1,
        ]);

        DB::table('users')->insert([
                'name' => 'Empleado Dos',
                'email' => 'empleado_dos@hotmail.com',
                'password' => bcrypt('empleado2'),
                'type' => 'EMPLEADO',
                'status' => 'ACTIVO',
                'idSucursal' => 2,
        ]);

        DB::table('users')->insert([
                'name' => 'Empleado Tres',
                'email' => 'empleado_tres@hotmail.com',
                'password' => bcrypt('empleado3'),
                'type' => 'EMPLEADO',
                'status' => 'ACTIVO',
                'idSucursal' => 3,
        ]);
    }
}
