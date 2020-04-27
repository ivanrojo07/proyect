<?php

use App\Estado;
use App\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampecheMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $campeche = Estado::find(4);
        $query_rows = DB::connection('pgsql2')->select("select
        	distinct(info->>'id_mun') as id_mun,
        	info->>'nombre_mun' as nombre_mun,
        	info->>'lon_mun' as lon_mun,
        	info->>'lat_mun' as lat_mun
        	from cam");
        foreach ($query_rows as $element) {
        	$campeche_municipio = new Municipio([
        			'id' => $element->id_mun,
        			'nombre' => $element->nombre_mun,
        			'lat' => $element->lon_mun,
        			'long' => $element->lat_mun,
        			'estado_id' => $campeche->id
        		]);
        	$campeche_municipio->save();
        	var_dump($campeche_municipio);
        }
        var_dump($query_rows);
    }
}
