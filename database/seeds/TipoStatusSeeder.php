<?php

use App\Incidente\TipoStatus;
use Illuminate\Database\Seeder;

class TipoStatusSeeder extends Seeder
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
        	'activo',
        	'inactivo'
        ];
        foreach ($opciones as $key=>$opcion) {
        	$status = new TipoStatus([
        		'nombre' => $opcion
        	]);
        	$status->id = $key+1;
        	$status->save();
        	var_dump($status);
        }
    }
}
