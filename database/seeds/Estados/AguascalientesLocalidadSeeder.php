<?php

use App\Estado;
use App\Localidad;
use Illuminate\Database\Seeder;

class AguascalientesLocalidadSeeder extends Seeder
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
        	info->>'id_mun' as id_mun, 
        	info->>'id_loc' as id_loc,
        	info->>'nombre_loc' as nombre_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from agu ");
       	foreach ($query_rows as $element) {
       		$aguascalientes_localidad = new Localidad([
       				'id' 	 	=> $element->id_loc,
			    	'nombre' 	=> $element->nombre_loc,
			    	// se equivocaron en lat, lon
			    	// Comprueba que el primer número de la coordenada de latitud sea un valor comprendido entre -90 y 90.
			    	// Comprueba que el primer número de la coordenada de longitud sea un valor comprendido entre -180 y 180.
			    	// Fuente: https://support.google.com/maps/answer/18539?co=GENIE.Platform%3DDesktop&hl=es
					'lat' 	 	=> $element->lon_loc,
					'long' 	 	=> $element->lat_loc,
					'municipio_id'	=> $element->id_mun
       			]);
       		$aguascalientes_localidad->save();
       		var_dump($aguascalientes_localidad);
       	}
    }
}
