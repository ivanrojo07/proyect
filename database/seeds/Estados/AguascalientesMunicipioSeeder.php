<?php

use App\Municipio;
use App\Estado;
use Illuminate\Database\Seeder;

class AguascalientesMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $aguascalientes = Estado::find(1);

        $query_rows = DB::connection('pgsql2')->select("select 
        	distinct(info->>'id_mun') as id_mun, 
        	info->>'nombre_mun' as nombre_mun, 
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun  
        	from agu ");

       	foreach ($query_rows as $element) {
       		$aguascalientes_municipio = new Municipio([
       				'id' 	 	=> $element->id_mun,
			    	'nombre' 	=> $element->nombre_mun,
			    	// se equivocaron en lat, lon
			    	// Comprueba que el primer número de la coordenada de latitud sea un valor comprendido entre -90 y 90.
			    	// Comprueba que el primer número de la coordenada de longitud sea un valor comprendido entre -180 y 180.
			    	// Fuente: https://support.google.com/maps/answer/18539?co=GENIE.Platform%3DDesktop&hl=es
					'lat' 	 	=> $element->lon_mun,
					'long' 	 	=> $element->lat_mun,
					'estado_id'	=> $aguascalientes->id
       			]);
       		$aguascalientes_municipio->save();
       		var_dump($aguascalientes_municipio);
       	}
    }
}
