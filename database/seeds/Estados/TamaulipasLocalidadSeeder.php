<?php

use App\Estado;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;

class TamaulipasLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tam 28
        $tamaulipas = Estado::find(28);
        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'nombre_loc' as nombre_loc,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from tam");
        $id_anterior = 241903;
        foreach ($query_rows as $element) {
    		$id_anterior+=1;
    		$municipio = Municipio::where('nombre',$element->nombre_mun)->where('estado_id',$tamaulipas->id)->first();
    		$tamaulipas_localidad = new Localidad([
    			'id' => $id_anterior,
    			'nombre' => $element->nombre_loc,
    			'lat' => $element->lon_loc,
    			'long' => $element->lat_loc,
    			'municipio_id' => $municipio->id
    		]);
    		$tamaulipas_localidad->save();
    		var_dump($tamaulipas_localidad);
    	}
    }
}
