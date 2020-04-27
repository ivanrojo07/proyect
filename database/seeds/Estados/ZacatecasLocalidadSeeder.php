<?php

use App\Estado;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;

class ZacatecasLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //zac 32
        $zacatecas = Estado::find(32);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'nombre_loc' as nombre_loc,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from zac");
        $id_anterior = 296186;
        foreach ($query_rows as $element) {
        	$id_anterior +=1;
        	$municipio = Municipio::where('nombre',$element->nombre_mun)->where('estado_id',$zacatecas->id)->first();
        	$zacatecas_localidad = new Localidad([
        		'id' => $id_anterior,
        		'nombre' => $element->nombre_loc,
        		'lat' => floatval($element->lon_loc),
        		'long' => floatval($element->lat_loc),
        		'municipio_id' => $municipio->id
        	]);
        	$zacatecas_localidad->save();
        	var_dump($zacatecas_localidad);
        }
    }
}
