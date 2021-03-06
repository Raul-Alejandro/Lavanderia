<?php

use Illuminate\Database\Seeder;

class DryServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //'Funa'
    public function run()
    {
        $services = array(
    		['4','Abrigo de niña',79.72], 
            ['2','Abrigo de piel',189.18], 
            ['1','Abrigo de plumas',162.16],
    		['5','Abrigo largo',133.20], 
            ['3','Saco tres cuartos',121.62], 
            ['6','Almohada de plumas',46.78],
    		['7','Almohada normal',40.54], 
            ['9','Bandera',121.62], 
            ['10','Bandera monumental',337.84],
    		['8','Banderin',67.57], 
            ['11','Bata',81.09], 
            ['12','Bermudas',21.61],
    		['13','Bermudas niño',20.26], 
            ['14','Blusa',33.78],
            ['16','Blusa bordada',40.37],
            ['15','Blusa niño',21.63],
            ['17','Boina',28.37],
            ['19','Bolsa',47.30],
            ['18','Bolsa pintada',135.14],
            ['20','Botargas',211.25],
            ['143','Botas de gamuza o piel',94.59],
            ['21','Bufanda',20.26],
            ['22','Cachucha',33.78],
            ['23','Camino de mesa',41.71],
            ['24','Camisa',33.78],
            ['25','Camisa con piel',40.54],
            ['27','Carpetas',79.74],
            ['26','Cauda de reina o novia',67.57],
            ['29','Chal',33.78],
            ['30','Chaleco de piel',81.09],
            ['148','Chaleco de pluma de ganzo de niño',57.20],
            ['34','Chaleco de plumas',60.81],
            ['32','Chaleco de traje',27.02],
            ['33','Chaleco relleno',44.40],
            ['31','Chalina',20.26],
            ['28','Chalina Bordada',33.78],
            ['38','Chamarra con mangas de piel',128.38],
            ['39','Chamarra de piel',202.70],
            ['149','Chammrra de piel de niño planchada',51.91],
            ['40','Chamarra de piel pintada',432.43],
            ['41','Chamarra de plumas',127.73],
            ['43','Chamarra de plumas con piel',148.01],
            ['42','Chamarra de plumas de niño',70.27],
            ['35','Chamarra sencilla',87.83],
            ['36','Chamarra SEN con piel',102.33],
            ['44','Cobertor de cuna',54.05],
            ['45','Cobertor electrico IND',114.87],
            ['47','Cobertor electrico KZ',128.38],
            ['46','Cobertor electrico MAT',123],
            ['48','Cobertor IND',84.59],
            ['49','Cobertor MAT',108.11],
            ['145','Cojin chico',35],
            ['151','Cojin de edredon chico',20.02],
            ['146','Cojin grande',55],
            ['51','Corbata',20.26],
            ['150','Corsette bordado',40.76],
            ['75','Cortinas por metro cuadrado',27.02],
            ['52','Edredon de cuna',40.54],
            ['56','Edredon de plumas',184.28],
            ['53','Edredon IND',108.11],
            ['55','Edredon KZ',135.14],
            ['54','Edredon MAT',121.62],
            ['57','Estola de piel',94.72],
            ['58','Faja de smoking',16.22],
            ['59','Faja de smoking de niño',9.46],
            ['60','Falda',33.78],
            ['64','Falda Bordada',54.05],
            ['61','Falda de niña',22.98],
            ['62','Falda de piel',81.09],
            ['65','Falda larga',52.65],
            ['63','Fralda de tablones',67.41],
            ['66','Funda de almohada',16.22],
            ['67','Funda de cojin',22.98],
            ['68','Gaban',47.30],
            ['69','Gabardina',148.66],
            ['70','Gabardina de piel',202.70],
            ['71','Guantes de piel',33.78],
            ['72','Guantes tejidos',20.26],
            ['153','M2 de cortina con forro de piel',32.46],
            ['154','M2 de cortina de tela',25.95],
            ['76','Maletas',47.30],
            ['81','Mantel bordado',94.59],
            ['80','Mantel cuadrado o redondo',55.93],
            ['77','Mantel de pano rectangular',108.11],
            ['78','Mantel individual',20.26],
            ['79','Mantel rectangular',74.33],
            ['82','Mono de peluche',60],
            ['83','Mono de peluche grande',70],
            ['84','Mono de smoking',9.46],
            ['90','Pantalon',33.67],
            ['88','Pantalon Bordado',51.12],
            ['85','Pantalon con piel',60.81],
            ['86','Pantalon de niño',20.26],
            ['87','Pantalon de piel',70.27],
            ['89','Pantalon pintado',108.10],
            ['73','Pants dos piezas',54.05],
            ['74','Pants dos piezas de niño',47.30],
            ['91','Playera',31.09],
            ['92','Playera de niño',16.22],
            ['93','Rodapie',40.54],
            ['94','Ropon de bautizo',102.26],
            ['96','Sabana',33.78],
            ['95','Sabana de cajon',27.02],
            ['100','Saco',47.30],
            ['147','Saco',47.45],
            ['101','Saco bordado de dama',62.22],
            ['103','Saco bordado de niño',29.74],
            ['97','Saco con piel',60.81],
            ['157','Saco grueso',53.62],
            ['99','Saco de piel',94.59],
            ['152','Saco tres cuartos delgado',84.66],
            ['102','Saco imitacion MINK',63.25],
            ['104','Sarape',60.81],
            ['105','Servilletas',13.52],
            ['106','Shorts',21.53],
            ['107','Sleeping bag',108.11],
            ['108','Sleeping bag de plumas',148.66],
            ['109','Sudadera',43.24],
            ['110','Sudadera de niño',20.26],
            ['114','Sweter',54.05],
            ['111','Sweter bordado',63.25],
            ['113','Sweter con piel',74.33],
            ['115','Sweter de niño',28.37],
            ['112','Sweter tres cuartos',63.25],
            ['116','Tapete chico',94.59],
            ['118','Tapete grande',135.14],
            ['117','Tapete mediano',108.11],
            ['119','Tenis',54.05],
            ['120','Toalla de mano',16.22],
            ['121','Toalla de normal',20.26],
            ['122','Toga de graduacion',94.59],
            ['123','Traje completo de charro',162.16],
            ['124','Traje de charro dos piezas de niño',67.57],
            ['125','Traje dos piezas',81.09],
            ['126','Traje dos piezas con piel',106.29],
            ['130','Traje dos piezas con traje tres cuartos',94.59],
            ['127','Traje dos piezas de niño',54.05],
            ['128','Traje tres piezas',101.35],
            ['129','Traje tres piezas de niño',74.33],
            ['37','Chamarra SEN de niño',60.81],
            ['144','Vestido con saco',118.78],
            ['139','Vestido corto',81.09],
            ['141','Vestido corto bordado',108.11],
            ['137','Vestido de 15 años SEN',175.68],
            ['138','Vestido de fiesta bordado',118.40],
            ['131','Vestido de fiesta de niña',74.33],
            ['132','Vestido de niña sencillo',54.05],
            ['134','Vestido de novia sencillo',472.97],
            ['133','Vestido de novia bordado',567.56],
            ['135','Vestido de primera comunion',121.62],
            ['156','Vestido largo bordado',118.92],
            ['140','Vestido largo sencillo',108.11],
            ['155','Vestido largo sencillo con saco',118.92],
            ['136','Vestido de 15 años bordado',195.94],
            ['142','Zapatos de gamuza',67.57],
            ['158','Pañuelo',10.01],
            ['159','Colchoneta',135.85],
            ['160','Pantalon planchado',17.16],
            ['161','Saco planchado',22.88],
            ['162','Traje de dos piezas planchado',40.04],
            ['163','Chaleco relleno de niño',25.74],
            ['164','Saco de tres cuartos planchado',64.35],
            ['165','Vestido largo bordado planchado',27.20],
            ['166','Chamarra sencilla de niño',50.05],
            ['167','Mono de peluche extra grande',71.50],
            ['168','Abrigo planchado',67.28],
            ['169','Camisa planchada',20.02],
            ['170','Disfras',85.80],
            ['172','Chamarra sencilla pintada',185.90],
            ['173','Overol',81.09],
            ['174','Chamarra SEN de niño',57.20],
            ['175','Zapatos de piel de niño',37.75],
            ['176','Vestido largo sencillo planchado',57.20],
            ['177','Sarape de niño',31.46],
            ['178','Chaleco de pluma de ganso de niño',42.90],
            ['179','Camisa planchada',17.16],
            ['180','Chaleco planchado',21.45],
            ['181','Chamarra magas de piel pintada',195.91],
            ['182','Falda de 15 años planchada',128.70],
            ['183','Falda de vestido de 15 años',130],
            ['184','Respaldo',65],
            ['185','Protector de cama',54.05],
            ['186','Short de niño',21.13],
            ['187','Vestido corto planchado',45.50],
            ['188','Cobertor de plancha',59.80],
            ['189','Velo planchado',17.94],
            ['190','Ornamento de sacerdote',108.11],
            ['191','Uniforme escolar de niño',54.05],
            ['192','Chaleco de niño',22.75],
            ['193','Vestido novia planchado',284.38],
            ['194','Saco grueso de niño',26],
            ['195','Juego de cuna',65],
            ['196','Juego de pants de dos piezas',81.09],
            ['197','Piel de borrego',130],
            ['198','Chamarra de piel planchada',81.25],
            ['199','Vestido corto planchado',41.60],
            ['200','Chaleco imitacion MINK',44.20],
            ['201','Velo',26],
            ['202','Crinolina',58.50],
    	);

    	foreach($services as $service){
    		DB::table('dry_cleaner_services')->insert([
            	'code' => $service[0],
        	    'name' => $service[1],
    	        'cost' => $service[2]
        	]);
    	}
    }
}
