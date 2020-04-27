<?php

use App\Incidente\TipoSeguimiento;
use Illuminate\Database\Seeder;

class TipoSeguimientoSeeder extends Seeder
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
        	'inicial',
        	'único',
        	'seguimiento',
        	'final'
        ];
        foreach ($opciones as $key=>$opcion) {
        	$seguimiento = new TipoSeguimiento([
        		'nombre' => $opcion
        	]);
        	$seguimiento->id = $key+1;
        	$seguimiento->save();
        	var_dump($seguimiento);
        }
    }
}
