<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiapasMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $chiapas = Estado::find(5);
        $query_rows = DB::connection('pgsql2')->select("select 
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from chp");
        foreach ($query_rows as $element) {
        	$chiapas_municipio = new Municipio([
        			'id' 		=> $element->id_mun,
        			'nombre' 	=> $element->nombre_mun,
        			'lat' 		=> $element->lon_mun,
        			'long' 		=> $element->lat_mun,
        			'estado_id' => $chiapas->id
        		]);
        	$chiapas_municipio->save();
        	var_dump($chiapas_municipio);
        }
        var_dump($query_rows);
    }
}
