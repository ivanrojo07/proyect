<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;

class GuanajuatoMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $guanajuato = Estado::find(11);
        $query_rows = DB::connection('pgsql2')->select("select
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from gua");
        foreach ($query_rows as $element) {
        	$guanajuato_municipio = new Municipio([
        			'id' => $element->id_mun,
        			'nombre' =>$element->nombre_mun,
        			'lat' => $element->lon_mun,
        			'long' => $element->lat_mun,
        			'estado_id' => $guanajuato->id
        		]);
        	$guanajuato_municipio->save();
        	var_dump($guanajuato_municipio);
        }
    }
}
