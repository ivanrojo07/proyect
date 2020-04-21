<?php

use App\Estado;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;

class QueretaroLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //qto
        // DB::delete('delete from localidads where id > 195865');
        // dd('hecho');
        $queretaro = Estado::find(22);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'nombre_loc' as nombre_loc,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from qto");
        $id_anterior = 195865;
        foreach ($query_rows as $element) {
        	$id_anterior += 1;
        	$municipio = Municipio::where('nombre',$element->nombre_mun)->where('estado_id',$queretaro->id)->first();
        	$queretaro_localidad = new Localidad([
        		'id' => $id_anterior,
        		'nombre' => $element->nombre_loc,
        		'lat' => $element->lon_loc,
        		'long' => $element->lat_loc,
        		'municipio_id' => $municipio->id
        	]);
        	$queretaro_localidad->save();
        	var_dump($queretaro_localidad);
        }
    }
}
