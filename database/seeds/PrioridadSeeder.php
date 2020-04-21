<?php

use App\Incidente\Prioridad;
use Illuminate\Database\Seeder;

class PrioridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $prioridades = [
        	'alta',
        	'media',
        	'baja'
        ];
        foreach ($prioridades as $key=>$value) {
        	$prioridad = new Prioridad([
        		'nombre' => $value
        	]);
        	$prioridad->id = $key+1;
        	$prioridad->save();
        }
    }
}
