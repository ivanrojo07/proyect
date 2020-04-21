<?php

use App\Incidente\TipoImpacto;
use Illuminate\Database\Seeder;

class TipoImpactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $opciones = [
        	'alto',
        	'medio',
        	'bajo'
        ];
        foreach ($opciones as $key=>$opcion) {
        	$impacto = new TipoImpacto([
        		'nombre' => $opcion
        	]);
        	$impacto->id = $key+1;
        	$impacto->save();
        	var_dump($impacto);
        }
    }
}
