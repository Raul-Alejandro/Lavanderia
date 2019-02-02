<?php

use Illuminate\Database\Seeder;

class PruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventories = array(
        	['productoUno','LITROS',15,1],
        	['productoDos','LITROS',20,2],
        	['productoTres','KILOS',2,1],
        	['productoCuatro','UNIDADES',10,3],
        	['productoCinco','LITROS',6,2],
        	['productoSeis','KILOS',18,3],
        	['productoSiete','UNIDADES',4,1],
        	['productoOcho','LITROS',55,2],
        	['productoNueve','KILOS',22,1],
        	['productoDiez','UNIDADES',44,3],
        	['productoOnce','LITROS',85,3],
        	['productoDoce','KILOS',13,3],
        	['productoTrece','UNIDADES',42,3],
        	['productoCatorce','LITROS',5,2],
        	['productoQuince','KILOS',8,2],
        	['productoDieciseis','UNIDADES',52,1],
        	['productoDiecisiete','LITROS',14,2],
        	['productoDieciocho','KILOS',26,1],
        	['productoDiecinueve','UNIDADES',34,3],
        	['productoVeinte','LITROS',84,1],
        	['productoVeintiuno','KILOS',71,1],
        	['productoVeintidos','UNIDADES',12,2],
        	['productoVeintitres','LITROS',59,3],
        	['productoVeinticuatro','KILOS',61,3],
        	['productoVeinticinco','UNIDADES',43,2],
        	['productoVeintiseis','LITROS',27,1],
        	['productoVeintisiete','KILOS',50,2],
        	['productoVeintiocho','UNIDADES',33,1],
        	['productoVeintinueve','LITROS',11,1],
        	['productoTreinta','KILOS',46,1],
        	['productoTreintaiuno','UNIDADES',95,2],
        	['productoTreintaidos','LITROS',2,3],
        	['productoTreintaitres','KILOS',9,3],
        	['productoTreintaicuatro','UNIDADES',16,2],
        	['productoTreintaicinco','LITROS',28,2],
        	['productoTreintaiseis','KILOS',31,2],
        	['productoTreintaisiete','UNIDADES',7,3],
        );

		foreach($inventories as $inventory){
    		DB::table('inventories')->insert([
            	'product' => $inventory[0],
        	    'measure' => $inventory[1],
                'quantity' => $inventory[2],
    	        'idSucursal' => $inventory[3]
        	]);
    	}

    	$customers = array(
    		['Juan','84412346',1],
    		['Maria','84432165',2],
    		['Edgardo','84125662',3],
    		['Roberto','84412346',1],
    		['Luis','84432165',2],
    		['Orlando','84125662',3],
    		['Raul','84412346',1],
    		['Eduardo','84432165',2],
    		['Nayeli','84125662',3],
    		['Rola','84412346',1],
    		['Missa','84432165',2],
    		['Ramon','84125662',3],
    		['Lupe','84412346',1],
    		['Fernanda','84432165',2],
    		['Dariela','84125662',3],
    		['Patricia','84412346',1],
    		['Jesus','84432165',2],
    		['Sergio','84125662',3],
    		['Amparo','84412346',1],
    		['Jose','84432165',2],
    		['Cristina','84125662',3],
    		['Miriam','84412346',1],
    		['Selena','84432165',2],
    		['Diego','84125662',3],
    	);

    	foreach($customers as $customer){
    		DB::table('customers')->insert([
            	'name' => $customer[0],
        	    'phone' => $customer[1],
    	        'idSucursal' => $customer[2]
        	]);
    	}
    }
}
