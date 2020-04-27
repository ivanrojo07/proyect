<?php

use App\Estado;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;

class SinaloaLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sin
        $sinaloa = Estado::find(25);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'id_mun' as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'nombre_loc' as nombre_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from sin");
        $id_anterior = 212234;
        foreach ($query_rows as $element) {
        	$id_anterior+=1;
        	$municipio = Municipio::where('nombre',$element->nombre_mun)->where('estado_id',$sinaloa->id)->first();
        	$sinaloa_localidad = new Localidad([
        		'id' => $id_anterior,
        		'nombre' => $element->nombre_loc,
        		'lat' => $element->lon_loc,
        		'long' => $element->lat_loc,
        		'municipio_id' => $municipio->id
        	]);
        	$sinaloa_localidad->save();
        	var_dump($sinaloa_localidad);
        }

    }
}
