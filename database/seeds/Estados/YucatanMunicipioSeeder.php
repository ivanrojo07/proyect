<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;

class YucatanMunicipioSeeder extends Seeder
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
        	distinct on (info->>'id_mun') 
        	info->>'id_mun' as id_mun,
        	info->>'nombre_loc' as nombre_loc,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'id_loc' as id_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from yuc ORDER BY id_mun ASC");
        $id_anterior = 2299;
        foreach($query_rows as $element){
        	$id_anterior +=1;
        	$yucatan_municipio = new Municipio([
        		'id' => $id_anterior,
        		'nombre' => $element->nombre_mun,
        		'lat' => $element->lon_loc,
        		'long' => $element->lat_loc,
        		'estado_id' => $yucatan->id
        	]);
        	$yucatan_municipio->save();
        	var_dump($yucatan_municipio);
        }
    }
}
