<?php

use App\Municipio;
use Illuminate\Database\Seeder;

class PeruLocalidadsCoordenadas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $municipios = Municipio::where('id','>',20000)->get();
        foreach ($municipios as $municipio) {
        	foreach ($municipio->localidads as $localidad) {
        		$localidad->lat = $municipio->lat;
        		$localidad->long = $municipio->long;
        		$localidad->save();
        		var_dump($localidad);
        	}
        }
    }
}
