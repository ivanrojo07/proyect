<?php

use App\Estado;
use App\Localidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChihuahuaLocalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $chihuahua = Estado::find(6);

        $query_rows = DB::connection('pgsql2')->select("select
        	info->>'id_mun' as id_mun,
        	info->>'id_loc' as id_loc,
        	info->>'nombre_loc' as nombre_loc,
        	info->>'lon_loc' as lon_loc,
        	info->>'lat_loc' as lat_loc
        	from chh");
        foreach ($query_rows as $element) {
        	$chihuahua_localidad = new Localidad([
        		'id' => $element->id_loc,
        		'nombre' => $element->nombre_loc,
        		'lat' => $element->lon_loc,
        		'long' => $element->lat_loc,
        		'municipio_id' => $element->id_mun
        	]);
        	$chihuahua_localidad->save();
        	var_dump($chihuahua_localidad);
        }
    }
}
