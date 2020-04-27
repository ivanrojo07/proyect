<?php

use App\Incidente\CategoriaIncidente;
use App\Incidente\SubcategoriaIncidente;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $query_rows = DB::connection('pgsql2')->select("select distinct * from categoria_cnie2 ORDER BY categoria ASC");
        foreach ($query_rows as $row) {
        	$categoria = CategoriaIncidente::where('nombre',$row->categoria)->first();
        	$subcategoria = new SubcategoriaIncidente([
        		'nombre' => ($row->subcategoria ? $row->subcategoria : 'Demo'),
        	]);
        	$subcategoria->id = ($row->idsubcat ? $row->idsubcat : 801);
        	$subcategoria->categoria_id = $categoria->id;
        	$subcategoria->save();
        	var_dump($subcategoria);
        }
    }

}
