<?php

use App\Incidente\CatalogoIncidente;
use Illuminate\Database\Seeder;

class GetCatalogoNacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $incidentes = CatalogoIncidente::where('catalogo_id',2)->get();
        $sentencia = "";
        foreach ($incidentes as $incidente) {
            $sentencia .="UPDATE catalogo_incidentes set catalogo_id = 2 WHERE id = ".$incidente['id'].";";
        }
        dd($sentencia);
    }
}
