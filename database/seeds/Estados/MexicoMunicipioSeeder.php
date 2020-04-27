<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;

class MexicoMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $edo_mex = Estado::find(15);

        $query_rows = DB::connection('pgsql2')->select("select
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from mex");
        foreach ($query_rows as $element) {
        	$edo_mex_municipio = new Municipio([
        			'id' => $element->id_mun,
        			'nombre' => $element->nombre_mun,
        			'lat' => $element->lon_mun,
        			'long' => $element->lat_mun,
        			'estado_id' => $edo_mex->id
        		]);
        	$edo_mex_municipio->save();
        	var_dump($edo_mex_municipio);
        }
    }
}
