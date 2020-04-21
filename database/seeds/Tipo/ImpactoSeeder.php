<?php

use App\Incidente\TipoImpacto;
use Illuminate\Database\Seeder;

class ImpactoSeeder extends Seeder
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
        foreach ($opciones as $opcion) {
        	$impacto = new TipoImpacto([
        		'nombre' => $opcion
        	]);
        	$impacto->save();
        	var_dump($impacto);
        }
    }
}
