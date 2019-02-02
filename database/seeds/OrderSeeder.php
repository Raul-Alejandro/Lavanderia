<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$customers = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
        $descounts = [10,20,30,40,50];*/
        $orders = [];
        $dates = ['2019-01-01 14:35:00','2019-01-02 10:00:00', '2019-01-03 17:08:00'];
        $delivery_date = ['2019-01-05','2019-01-06','2019-01-07'];
        $hours = ['9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm','3:00pm','4:00pm','5:00pm','6:00pm','7:00pm','8:00pm','9:00pm','10:00pm'];
        $payment = ['EFECTIVO','TARJETA'];
        //customers/delivery_date/descount/status/total/t_wash/t_iron/t_dry/payment_type/idUser/idSucursal
        //orders.size = 12
        for($i = 0; $i<=1000; $i++){
        	$orders[] = [rand(1,24),$delivery_date[array_rand($delivery_date)].' '.$hours[array_rand($hours)],rand(0,50),'UNPAID',rand(100,1000),rand(100,500),rand(9,90),rand(100,500),rand(100,500),$payment[array_rand($payment)],rand(1,4),rand(1,3),$dates[array_rand($dates)]];
        }

        foreach($orders as $key => $order){
        	DB::table('orders')->insert([
        		'idCustomer' => $order[0],
        		'delivery_date' => $order[1],
        		'descount' => $order[2],
        		'status' => $order[3],
        		'total' => $order[4],
        		'total_wash' => $order[5],
        		'total_iron' => $order[6],
        		'total_dry' => $order[7],
                'balance' => $order[8],
        		'payment_type' => $order[9],
        		'idUser' => $order[10],
        		'idSucursal' => $order[11],
        		'created_at' => date("Y-m-d H:i:s")
        	]);	

        	$num = rand(1,3);
        	for($w = 0; $w<=$num; $w++){
	        	DB::table('wash_orders')->insert([
	        		'quantity' => rand(1,5),
	        		'free' => 'NO',
	        		'service' => rand(1,15),
	        		'cost' => rand(100,300),
	        		'idOrder' => $key+1
	        	]);
        	}

        	$num = rand(1,3);
        	for($i = 0; $i<=$num; $i++){
	        	DB::table('iron_orders')->insert([
	        		'quantity' => rand(1,5),
	        		'promotion' => 'NO',
	        		'free' => 'NO',
	        		'service' => rand(1,15),
	        		'cost' => rand(100,300),
	        		'idOrder' => $key+1
	        	]);
        	}

        	$num = rand(1,3);
        	for($d = 0; $d<=$num; $d++){
	        	DB::table('dry_cleaner_orders')->insert([
	        		'quantity' => rand(1,5),
	        		'service' => rand(1,15),
	        		'cost' => rand(100,300),
	        		'idOrder' => $key+1
	        	]);
        	}
        }

        /*$orders = array(	
        	[rand(1,24),array_rand($delivery_date).' '.array_rand($hours),rand(0,50),'UNPAID',rand(100,1000),rand(100,500),rand(9,90),rand(100,500),array_rand($payment),rand(1,4)],
        )*/
    }
}
