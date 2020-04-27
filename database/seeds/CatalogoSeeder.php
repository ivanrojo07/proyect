<?php

use App\Incidente\CatalogoIncidente;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $query_rows = DB::connection("pgsql2")->select("select distinct on (lower(incidente)) idinc as idinc, lower(incidente) as incidente, idprioridad as idprioridad, idsubcat as idsubcat from incidentes_cnie2 inc ORDER BY incidente ASC");
        foreach ($query_rows as $key=>$row) {
        	$catalogo = new CatalogoIncidente([
        		'nombre' => $row->incidente,
        		'clave' => $row->idinc
        	]);
            $catalogo->id = $key+1;
        	$catalogo->prioridad_id = $row->idprioridad;
        	$catalogo->subcategoria_id = $row->idsubcat;
        	$catalogo->save();
        	var_dump($catalogo);
        	
        }
    }
}
