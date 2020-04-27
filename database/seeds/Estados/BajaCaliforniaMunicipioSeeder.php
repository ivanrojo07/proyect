<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BajaCaliforniaMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $baja_california = Estado::find(2);
        $query_rows = DB::connection('pgsql2')->select("select
        		distinct(info->>'id_mun') as id_mun,
        		info->>'nombre_mun' as nombre_mun,
        		info->>'lon_mun' as lon_mun,
        		info->>'lat_mun' as lat_mun
        		from bcn");
        
        foreach ($query_rows as $element) {
        	$baja_california_municipio = new            Municipio([
        			'id' 		=> $element->id_mun,
        			'nombre' 	=> $element->nombre_mun,
        			// se equivocaron en lat, lon
			    	// Comprueba que el primer número de la coordenada de latitud sea un valor comprendido entre -90 y 90.
			    	// Comprueba que el primer número de la coordenada de longitud sea un valor comprendido entre -180 y 180.
			    	// Fuente: https://support.google.com/maps/answer/18539?co=GENIE.Platform%3DDesktop&hl=es
        			'lat' 		=> $element->lon_mun,
        			'long' 		=> $element->lat_mun,
        			'estado_id' => $baja_california->id
        		]);
        	$baja_california_municipio->save();
        	var_dump($baja_california_municipio);
        	
        }
    }
}
