<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BajaCaliforniaSurMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $baja_california_sur = Estado::find(3);
        $query_rows = DB::connection('pgsql2')->select("select
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from bcs");

        foreach ($query_rows as $element) {
        	$baja_california_sur_municipio = new Municipio([
        			'id' 		=> $element->id_mun,
        			'nombre' 	=> $element->nombre_mun,
        			'lat' 		=> $element->lon_mun,
        			'long' 		=> $element->lat_mun,
        			'estado_id' => $baja_california_sur->id
        		]);
        	$baja_california_sur_municipio->save();
        	var_dump($baja_california_sur_municipio);
        }
        var_dump(count($query_rows));

    }
}
