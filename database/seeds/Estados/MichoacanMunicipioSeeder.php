<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;

class MichoacanMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //mic
        $michoacan = Estado::find(16);
        $query_rows = DB::connection('pgsql2')->select("select
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from mic ");
        
        foreach ($query_rows as $element) {
        	$michoacan_municipio = new Municipio([
        			'id' => $element->id_mun,
        			'nombre' => $element->nombre_mun,
        			'lat' => $element->lon_mun,
        			'long' => $element->lat_mun,
        			'estado_id' => $michoacan->id
        		]);
        	$michoacan_municipio->save();
        	var_dump($michoacan_municipio);
        }

    }
}
