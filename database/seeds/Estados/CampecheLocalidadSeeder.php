<?php

use App\Estado;
use App\Localidad;
use Illuminate\Database\Seeder;

class CampecheLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $campeche = Estado::find(4);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'id_mun' as id_mun,
        	info->>'id_loc' as id_loc,
        	info->>'nombre_loc' as nombre_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from cam");
        foreach ($query_rows as $element) {
        	$campeche_localidad = new Localidad([
        		'id' 			=> $element->id_loc,
        		'nombre' 		=> $element->nombre_loc,
        		'lat' 			=> $element->lon_loc,
        		'long' 			=> $element->lat_loc,
        		'municipio_id' 	=> $element->id_mun
        	]);
        	$campeche_localidad->save();
        	var_dump($campeche_localidad);
        }

    }
}
