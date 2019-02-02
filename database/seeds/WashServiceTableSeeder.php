<?php

use Illuminate\Database\Seeder;

class WashServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$services = array(
    		['0001','Edredones de Borrega (JUMBO)','CANTIDAD',150], 
            ['0002','Edredones de Borrega (KING O QUEEN)','CANTIDAD',110], 
            ['0003','Edredones de Borrega (MATRIMONIAL)','CANTIDAD',100],
    		['0004','Edredones de Borrega (INDIVIDUAL)','CANTIDAD',90], 
            ['0005','Edredones (KING O QUEEN)','CANTIDAD',100], 
            ['0006','Edredones (MATRIMONIAL)','CANTIDAD',90],
    		['0007','Edredones (INDIVIDUAL)','CANTIDAD',80], 
            ['0008','Cobertores y Edrecolchas (JUMBO)','CANTIDAD',250],
            ['0009','Cobertores y Edrecolchas (KING O QUEEN)','CANTIDAD',100], 
            ['0010','Cobertores y Edrecolchas (MATRIMONIAL)','CANTIDAD',90],
    		['0011','Cobertores y Edrecolchas (INDIVIDUAL)','CANTIDAD',80], 
            ['0012','Renta de Lavadora','CANTIDAD',27], 
            ['0013','Renta de Lavadora y Secadora','CANTIDAD',54],
    		['0014','Secado por kilo','PESO',17], 
            ['0015','Ropa por Encargo por kilo (Normal)','PESO',27],
            ['0015','Ropa por Encargo por kilo (Ensueño)','PESO',30],
    	);

    	foreach($services as $service){
    		DB::table('wash_services')->insert([
            	'code' => $service[0],
        	    'name' => $service[1],
                'measure' => $service[2],
    	        'cost' => $service[3]
        	]);
    	}
    }
}
