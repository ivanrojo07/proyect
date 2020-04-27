<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;

class SinaloaMunicipioSeeder extends Seeder
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
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from sin");
        $id_anterior = 1877;
        foreach ($query_rows as $element) {
        	$id_anterior+=1;
        	$sinaloa_municipio = new Municipio([
        		'id' => $id_anterior,
        		'nombre'=> $element->nombre_mun,
        		'lat' => $element->lon_mun,
        		'long' => $element->lat_mun,
        		'estado_id' => $sinaloa->id
        	]);
        	$sinaloa_municipio->save();
        	var_dump($sinaloa_municipio);
        }
    }
}
