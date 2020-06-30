<?php

use App\Estado;
use Illuminate\Database\Seeder;

class PrefijoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estados =[
        	[
        		"estado"=> "Aguascalientes",
        		"prefijo" => "agu" 
        	],
			[
				"estado"=>"Baja California",
				"prefijo"=>"bcn"
			],
			[
				"estado"=>"Baja California Sur",
				"prefijo"=>"bcs"
			],
			[
				"estado"=>"Campeche",
				"prefijo"=>"cam"
			],
			[
				"estado"=>"Chiapas",
				"prefijo"=>"chp"
			],
			[
				"estado"=>"Chihuahua",
				"prefijo"=>"chh"
			],
			[
				"estado"=>"Coahuila de Zaragoza",
				"prefijo"=>"coa"
			],
			[
				"estado"=>"Colima",
				"prefijo"=>"col"
			],
			[
				"estado"=>"Durango",
				"prefijo"=>"dur"
			],
			[
				"estado"=>"Guanajuato",
				"prefijo"=>"gua"
			],
			[
				"estado"=>"Guerrero",
				"prefijo"=>"gro"
			],
			[
				"estado"=>"Hidalgo",
				"prefijo"=>"hid"
			],
			[
				"estado"=>"Jalisco",
				"prefijo"=>"jal"
			],
			[
				"estado"=>"Estado de México",
				"prefijo"=>"mex"
			],
			[
				"estado"=>"Michoacan de Ocampo",
				"prefijo"=>"mic"
			],
			[
				"estado"=>"Morelos",
				"prefijo"=>"mor"
			],
			[
				"estado"=>"Nayarit",
				"prefijo"=>"nay"
			],
			[
				"estado"=>"Nuevo León",
				"prefijo"=>"nle"
			],
			[
				"estado"=>"Oaxaca",
				"prefijo"=>"oax"
			],
			[
				"estado"=>"Puebla",
				"prefijo"=>"pue"
			],
			[
				"estado"=>"Querétaro",
				"prefijo"=>"qto"
			],
			[
				"estado"=>"Quintana Roo",
				"prefijo"=>"roo"
			],
			[
				"estado"=>"San Luis Potosí",
				"prefijo"=>"slp"
			],
			[
				"estado"=>"Sinaloa",
				"prefijo"=>"sin"
			],
			[
				"estado"=>"Sonora",
				"prefijo"=>"son"
			],
			[
				"estado"=>"Tabasco",
				"prefijo"=>"tab"
			],
			[
				"estado"=>"Tamaulipas",
				"prefijo"=>"tam"
			],
			[
				"estado"=>"Tlaxcala",
				"prefijo"=>"tla"
			],
			[
				"estado"=>"Veracruz",
				"prefijo"=>"ver"
			],
			[
				"estado"=>"Yucatán",
				"prefijo"=>"yuc"
			],
			[
				"estado"=>"Zacatecas",
				"prefijo"=>"zac"
			],
			[
				"estado"=>"Ciudad de México",
				"prefijo"=>"cmx"
			],
        ];

        foreach ($estados as $value) {
        	$db = Estado::where('nombre',$value['estado'])->first();
        	$db->prefijo = $value['prefijo'];
        	$db->save();
        }
    }
}
