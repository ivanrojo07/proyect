<?php

use App\Incidente\CategoriaIncidente;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $query_rows = DB::connection('pgsql2')->select("select distinct categoria as categoria from categoria_cnie2 ORDER BY categoria ASC");
        foreach ($query_rows as $key=>$value) {
        	$categoria = new CategoriaIncidente([
        		'nombre' => $value->categoria
        	]);
        	$categoria->id = $key+1;
        	$categoria->save();
        	var_dump($categoria);
        }
    }
}
