<?php

use App\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $query_rows = DB::connection('pgsql2')->table('estados')->get();
        foreach ($query_rows as $element) {
        	$estado = new Estado([
        			'id' => $element->id_estado,
    				'nombre' => $element->nombre,
        		]);
        	$estado->save();
        }
    }
}
