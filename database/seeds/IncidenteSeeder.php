<?php

use App\Dependencia\Dependencia;
use App\Dependencia\ReporteDependencia;
use App\Incidente\CatalogoIncidente;
use App\Incidente\RegistroIncidente;
use App\Localidad;
use App\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class IncidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estados = [
        	'coa'=>[
        		'prefijo'=>'coa',
        		'id'=>7
        	],
        	'cam'=>[
        		'prefijo'=>'cam',
        		'id'=> 4
        	],
        	'dur'=>[
        		'prefijo'=>'dur',
        		'id'=>10
        	],
        	'gro'=>[
        		'prefijo'=>'gro',
        		'id'=>12
        	],
        	'bcs'=>[
        		'prefijo'=>'bcs',
        		'id'=>3
        	],
        	'tla'=>[
        		'prefijo'=>'tla',
        		'id'=>29
        	],
        	'chp'=>[
        		'prefijo'=>'chp',
        		'id'=>5
        	],
        	'agu'=>[
        		'prefijo'=>'agu',
        		'id'=>1
        	],
        	'cmx'=>[
        		'prefijo'=>'cmx',
        		'id'=>9
        	],
        	'mex'=>[
        		'prefijo'=>'mex',
        		'id'=>15
        	],
        	'sin'=>[
        		'prefijo'=>'sin',
        		'id'=>25
        	],
        	'bcn'=>[
        		'prefijo'=>'bcn',
        		'id'=>2
        	]
        ];
       	DB::connection('pgsql2')->table('contenidoincidentes')->orderBy('numserie')->chunk(100, function($rows) use ($estados){
       		$serie_anterior = 0;
       		$id_anterior = 0;
       		foreach ($rows as $row) {
       			$zonas_afectadas = json_decode($row->zonas_afectadas);
       			$ubicacion_especifica = json_decode($row->ubicacion_especifica,true);
       			$respuesta_institucional = json_decode($row->respuesta_institucional,true);
       			$registro = new RegistroIncidente([
       				'descripcion' => ($row->descripcion ? $row->descripcion : "Nada"),
			    	'lat_especifica' => ($ubicacion_especifica ? ($ubicacion_especifica['lat'] ? $ubicacion_especifica['lat'] : 0.0 ) : 0.0),
			    	'long_especifica' => ($ubicacion_especifica ? ($ubicacion_especifica['long'] ? $ubicacion_especifica['long'] : 0.0) : 0.0),
			    	'lugares_afectados' => $row->poblaciones_afectadas ,
			    	'fecha_ocurrencia' => ( $row->f_ocurrencia ? $row->f_ocurrencia : Date('Y-m-d')),
			    	'hora_ocurrencia' => ($row->h_ocurrencia ? $row->h_ocurrencia : Date('H:i:s')),
			    	'afectacion_vial' => $row->afectacion_vial,
			    	'afectacion_infraestructural' => $row->infraestructura_afectada,
			    	'danio_colateral' => ($row->danio_colaterales ? $row->danio_colaterales : 0),
			    	'estatus' => ($row->activo ? true : false),
			    	'medidas_control' => ($row->medidas_control ? $row->medidas_control : 'Nada'),
			    	'personas_afectadas' => ($row->p_afectadas ? $row->p_afectadas  : 0),
			    	'personas_lesionadas' => ($row->p_lecionadas ? $row->p_lecionadas : 0),
			    	'personas_fallecidas' => ($row->p_fallecidas ? $row->p_fallecidas : 0),
			    	'personas_desaparecidas' => ($row->p_desaparecidas ? $row->p_desaparecidas : 0),
			    	'personas_evacuadas' => ($row->p_evacuadas ? $row->p_evacuadas : 0),
			    	'dependencia'=> ($respuesta_institucional && !empty($respuesta_institucional) ? ($respuesta_institucional['dependencia'] ? $respuesta_institucional['dependencia'] : 'Sin dependencia' ) : 'Sin dependencia'),
			    	'nombre_empleado' => ($respuesta_institucional && !empty($respuesta_institucional) ? ($respuesta_institucional['nombretrabdep'] ? $respuesta_institucional['nombretrabdep'] : 'Sin dependencia' ) : 'Sin dependencia'),
			    	'cargo_empleado' => ($respuesta_institucional && !empty($respuesta_institucional) ? ($respuesta_institucional['cargotrabdep'] ? $respuesta_institucional['cargotrabdep'] : 'Sin dependencia' ) : 'Sin dependencia')
       			]);
       			$incidente = DB::connection('pgsql2')->select("select * from incidentes_cnie2 where idinc like '%$row->idinc%' ");
       			if (!empty($incidente)) {
       				$catalogo = CatalogoIncidente::where('nombre','LIKE',"%".strtolower($incidente[0]->incidente)."%")->first();
       			}
       			else{
       				$catalogo = CatalogoIncidente::find(144);
       			}
       			$registro->catalogo_incidente_id = $catalogo['id'];
       			$registro->estado_id = ($row->prefijo_estado == null ? 9 : $estados[$row->prefijo_estado]['id']);
       			$registro->tipo_seguimiento_id = ($row->id_tiposeguimiento ? $row->id_tiposeguimiento : 2);
       			$registro->tipo_impacto_id = ($row->id_nivelimpacto ? $row->id_nivelimpacto : 3);
       			$registro->user_id = 2;
       			$registro->save();
       			if ($serie_anterior == $row->numserie) {
       				$registro->registro_incidente_id = $id_anterior;
       			}
       			$id_anterior = $registro->id;
       			$serie_anterior = $row->numserie;
       			$registro->save();
       			if ($zonas_afectadas && !empty($zonas_afectadas)) {
       				foreach ($zonas_afectadas as $zona) {
       					if (isset($zona->mun)) {
       						var_dump($zona->mun);
       						$municipio = Municipio::where('nombre','LIKE',"%".$zona->mun."%")->first();
       						$registro->municipio_id = $municipio->id;
       						$registro->save();
       					}
       					if (isset($zona->nombre_mun)) {
       						var_dump($zona->nombre_mun);
       						$municipio = Municipio::where('nombre','LIKE',$zona->nombre_mun."%")->first();
       						$registro->municipio_id = $municipio->id;
       						$registro->save();
       					}
       					if (isset($zona->loc)) {
       						var_dump($zona->loc);
       						$localidad = Localidad::where('nombre','LIKE',$zona->loc."%")->first();
       						var_dump($localidad ? $localidad : 'sin localidad');
       						$registro->localidades()->attach($localidad->id);
       					}
       					if (isset($zona->nombre_loc)) {
       						var_dump($zona->nombre_loc);
       						$localidad = Localidad::where('nombre','LIKE',$zona->nombre_loc."%")->first();
       						var_dump($localidad ? $localidad : 'sin localidad');
       						$registro->localidades()->attach($localidad->id);
       					}
       				}
       			}
       			$llamada_dependencia = json_decode($row->dependencias);
       			if (!empty($llamada_dependencia) || !is_null($llamada_dependencia)) {
	       			$dependencia = new Dependencia([
	       				"datos_llamada"=> $llamada_dependencia->datos_llamada,
	       				"tiempo_llamada"=>$llamada_dependencia->tiempo_llamada,
	       				"tiempo_atencion"=>$llamada_dependencia->tiempo_atencion,
	       				"descripcion_llamada"=>$llamada_dependencia->descripcion_llamada,
	       			]);
	       			if ($dependencia) {
	       				$registro->dependencia_llamada()->save($dependencia);
	       			}
       			}
       			$reportes = json_decode($row->reporte_dependencias);
       			if (!empty($reportes) || !is_null($reportes)) {

       				foreach ($reportes as $reporte) {
       					var_dump($row->serie); 
       					$reporte_dependencia = new ReporteDependencia([
       						'zp' => $reporte->zp,
							'sector' => $reporte->sector,
							'cuadrante' => $reporte->cuadrante,
							'h_lectura' => ($reporte->h_lectura == "FALTA" ? Date('H:i:s') : Date('H:i:s',strtotime($reporte->h_lectura))),
							'motivo' => $reporte->motivo_robo,
							'observacion' => $reporte->observacion,
							'f_transmision' => ($reporte->f_trasmision == "FALTA" ? Date('Y-m-d H:i:s') : Date('Y-m-d H:i:s',strtotime($reporte->f_trasmision))),
							'atencion' => $reporte->num_atencion,
							'razonamiento' => $reporte->razonamiento,
							'f_razonamiento' => ($reporte->f_razonamiento == "FALTA" ? Date('Y-m-d H:i:s') : Date('Y-m-d H:i:s',strtotime($reporte->f_razonamiento))),
							'obs_noatencion' => $reporte->obs_noatencion,
							'nombre_encargado' => $reporte->nombre_encargado,
							'razon_noatencion' => $reporte->razon_noatencion,
							'dependencia' => $reporte->nombre_dependencia,
							'folio' => $reporte->folio_parte_informativo
       					]);
       					$registro->dependencia_reportes()->save($reporte_dependencia);
       				}
       			}
       			
       			var_dump($registro);

       		}
       	});
        // dd($query_rows[0]);
    }
}
