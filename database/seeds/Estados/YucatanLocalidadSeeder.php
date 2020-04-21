<?php

use App\Estado;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;

class YucatanLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //yuc 31
        $yucatan = Estado::find(31);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'nombre_loc' as nombre_loc,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from yuc");
        $id_anterior = 285666;
        foreach ($query_rows as $element) {
    		$id_anterior+=1;
    		$municipio = Municipio::where('nombre',$element->nombre_mun)->where('estado_id',$yucatan->id)->first();
    		$yucatan_localidad = new Localidad([
    			'id' => $id_anterior,
    			'nombre' => $element->nombre_loc,
    			'lat' => floatval($element->lon_loc),
    			'long' => floatval($element->lat_loc),
    			'municipio_id' => $municipio->id
    		]);
    		$yucatan_localidad->save();
    		var_dump($yucatan_localidad);
    	}
    }
}
