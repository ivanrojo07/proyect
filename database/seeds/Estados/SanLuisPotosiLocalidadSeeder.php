<?php

use App\Estado;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;

class SanLuisPotosiLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //slp
        $san_luis_potosi = Estado::find(24);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'nombre_loc' as nombre_loc,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from slp");
        $id_anterior = 202985;
        foreach ($query_rows as $element) {
        	$id_anterior +=1;
        	$municipio = Municipio::where('nombre', $element->nombre_mun)->where('estado_id',$san_luis_potosi->id)->first();
        	$san_luis_potosi_localidad = new Localidad([
        		'id' => $id_anterior,
        		'nombre' => $element->nombre_loc,
        		'lat' => $element->lon_loc,
        		'long' => $element->lat_loc,
        		'municipio_id' => $municipio->id
        	]);
        	$san_luis_potosi_localidad->save();
        	var_dump($san_luis_potosi_localidad);
        }
    }
}
