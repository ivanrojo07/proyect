<?php

use App\Dependencia\Dependencia;
use App\Dependencia\ReporteDependencia;
use App\Incidente\CatalogoIncidente;
use App\Incidente\RegistroIncidente;
use App\Incidente\Serie;
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
        //obtenemos todos los prefijos de estado y el id de la tabla anterior
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
        /*Conectamos con la base de datos anterior(que dejo victor) y con la función chunk trabajamos de 100 en 100
        registros y encapsulando nuestro arreglo estados para usarlo*/
       	DB::connection('pgsql2')->table('contenidoincidentes')->orderBy('numserie')->chunk(100, function($rows) use ($estados){
          // bandera para guardar la serie del ultimo registro obtenido de la bd de victor
       		$serie_anterior = 0;
          // Mi id de la serie que mi bd esta utilizando
       		$id_anterior = 0;
          // Recorriendo los registros de la bd de victor
       		foreach ($rows as $row) {
            // obtenemos lista de las zonas afectadas del registro
       			$zonas_afectadas = json_decode($row->zonas_afectadas);
            // Obtenemos arreglo de las coordenadas de la ubicacion
       			$ubicacion_especifica = json_decode($row->ubicacion_especifica,true);
            // Obtenemos el arreglo de la respuesta institucional (puede estar null o un string vacio)
       			$respuesta_institucional = json_decode($row->respuesta_institucional,true);
            // Creamos un registro de incidente a mi base de datos
       			$registro = new RegistroIncidente([
              // COMO LA MAYORIA DE LOS REGISTROS SON CAMPOS NULLABLE
              // Si existe la descripción la tomamos, de lo contrario escribimos "Nada"
       				'descripcion' => ($row->descripcion ? $row->descripcion : "Nada"),
              // Verificamos que exista el arreglo ubicacion especifica (si no agregamos 0.0 al registro) y si tiene la llave lat
  			    	'lat_especifica' => ($ubicacion_especifica ? ($ubicacion_especifica['lat'] ? $ubicacion_especifica['lat'] : 0.0 ) : 0.0),
              // Verificamos que exista el arreglo ubicacion especifica (si no agregamos 0.0 al registro) y si tiene la llave long              
  			    	'long_especifica' => ($ubicacion_especifica ? ($ubicacion_especifica['long'] ? $ubicacion_especifica['long'] : 0.0) : 0.0),
  			    	'lugares_afectados' => $row->poblaciones_afectadas ,
              // Si existe fecha de ocurrencia la registramos, de lo contrario agregamos una fecha por defecto
  			    	'fecha_ocurrencia' => ( $row->f_ocurrencia ? $row->f_ocurrencia : Date('Y-m-d',strtotime("2019-10-08"))),
              // Si existe hora de ocurrencia la registramos, de lo contrario agregamos una hora por defecto
  			    	'hora_ocurrencia' => ($row->h_ocurrencia ? $row->h_ocurrencia : Date('H:i:s')),
              // Obtenemos la fecha de registro, de lo contrario obtenemos una fecha por default
              'fecha_registro' => ( $row->f_registro ? $row->f_registro : Date('Y-m-d',strtotime("2019-10-08"))),
              // Obtenemos una hora de registro, de lo contrario obtenemos una hora por defecto
              'hora_registro' => ($row->h_registro ? $row->h_registro : Date('H:i:s')),
  			    	'afectacion_vial' => $row->afectacion_vial,
  			    	'afectacion_infraestructural' => $row->infraestructura_afectada,
              // Si existe daño colaterales lo registramos, de lo contrario, agregar 0
  			    	'danio_colateral' => ($row->danio_colaterales ? $row->danio_colaterales : 0),
              // si existe el registro activo es true de lo contrario false
  			    	'estatus' => ($row->activo ? true : false),
              // si existe medidas de control, registrarlas, de lo contrario escribe nada
  			    	'medidas_control' => ($row->medidas_control ? $row->medidas_control : 'Nada'),
              // Campos de personas que fueron perjudicados en el incidente, si no existe agregamos cero
  			    	'personas_afectadas' => ($row->p_afectadas ? $row->p_afectadas  : 0),
  			    	'personas_lesionadas' => ($row->p_lecionadas ? $row->p_lecionadas : 0),
  			    	'personas_fallecidas' => ($row->p_fallecidas ? $row->p_fallecidas : 0),
  			    	'personas_desaparecidas' => ($row->p_desaparecidas ? $row->p_desaparecidas : 0),
  			    	'personas_evacuadas' => ($row->p_evacuadas ? $row->p_evacuadas : 0),
              // Si existe el arreglo respuesta institucional, no sea vacio y si tiene la llave dependencia lo registramos;
              // de lo contrario agregamos "sin dependencia"
  			    	'dependencia'=> ($respuesta_institucional && !empty($respuesta_institucional) ? ($respuesta_institucional['dependencia'] ? $respuesta_institucional['dependencia'] : 'Sin dependencia' ) : 'Sin dependencia'),
              // Si existe el arreglo respuesta institucional, no sea vacio y si tiene la llave nombretrabdep lo registramos;
              // de lo contrario agregamos "sin dependencia"
  			    	'nombre_empleado' => ($respuesta_institucional && !empty($respuesta_institucional) ? ($respuesta_institucional['nombretrabdep'] ? $respuesta_institucional['nombretrabdep'] : 'Sin dependencia' ) : 'Sin dependencia'),
              // Si existe el arreglo respuesta institucional, no sea vacio y si tiene la llave cargotrabdep lo registramos;
              // de lo contrario agregamos "sin dependencia"
  			    	'cargo_empleado' => ($respuesta_institucional && !empty($respuesta_institucional) ? ($respuesta_institucional['cargotrabdep'] ? $respuesta_institucional['cargotrabdep'] : 'Sin dependencia' ) : 'Sin dependencia')
       			]);
            // Obtenemos el registro del catalogo nacional de incidentes donde pertenece este incidente
       			$incidente = DB::connection('pgsql2')->select("select * from incidentes_cnie2 where idinc like '%$row->idinc%' ");
       			if (!empty($incidente)) {
              // si no esta vacio el select, hacemos una busqueda de ese incidente a mi bd
       				$catalogo = CatalogoIncidente::where('nombre','LIKE',"%".strtolower($incidente[0]->incidente)."%")->first();
       			}
       			else{
              // si esta vacio usamos el registro demo
       				$catalogo = CatalogoIncidente::find(144);
       			}
            // le damos al registro incidente el id del catalogo nacional de incidente
       			$registro->catalogo_incidente_id = $catalogo['id'];
            // Obtenemos el estado donde se sucito el registro, si no existe, usamos la ciudad de mexico
       			$registro->estado_id = ($row->prefijo_estado == null ? 9 : $estados[$row->prefijo_estado]['id']);
            //Obtenemos tipo de seguimiento del registro, si no existe agregamos uno por defecto
       			$registro->tipo_seguimiento_id = ($row->id_tiposeguimiento ? $row->id_tiposeguimiento : 2);
            // agregamos un tipo de impacto, si no existe agregamos uno por defecto
       			$registro->tipo_impacto_id = ($row->id_nivelimpacto ? $row->id_nivelimpacto : 3);
            // le damos el usuario que registro el incidente
       			$registro->user_id = 2;
            
            // Si la serie del registro anterior es igual al la serio de este incidente
       			if ($serie_anterior == $row->numserie) {
              // agregamos la serie bandera al registro
       				$registro->serie_id = $id_anterior;
       			}
            else{
              // De lo contrario creamos una serie en mi bd
              $serie = Serie::create([
                // Agregando el catalogo nacional de incidente y el estado
                'catalogo_incidente_id' => $catalogo->id,
                'estado_id' => ($row->prefijo_estado == null ? 9 : $estados[$row->prefijo_estado]['id'])
              ]);
              // Cambiamos la bandera anterior con la nueva
              $id_anterior = $serie->id;
              // Y agregamos la serie al registro
              $registro->serie_id = $id_anterior;
            }
            // cambiamos la bandera del la serie de la bd de victor 
       			$serie_anterior = $row->numserie;
            // Y guardamos el registro
       			$registro->save();
            // Si existio zona afectadas (el arreglo y no sea nulo)
       			if ($zonas_afectadas && !empty($zonas_afectadas)) {
              // Recorremos el arreglo
       				foreach ($zonas_afectadas as $zona) {
                // Buscamos en nuestro bd un registro que coincida con los diferentes campos de la bd de victor
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
            // Obtenemos el arreglo de las llamada de la dependencia
       			$llamada_dependencia = json_decode($row->dependencias);
       			if (!empty($llamada_dependencia) || !is_null($llamada_dependencia)) {
              // verificamos que exista y no sea nulo para crear una dependencia
	       			$dependencia = new Dependencia([
	       				"datos_llamada"=> $llamada_dependencia->datos_llamada,
	       				"tiempo_llamada"=>$llamada_dependencia->tiempo_llamada,
	       				"tiempo_atencion"=>$llamada_dependencia->tiempo_atencion,
	       				"descripcion_llamada"=>$llamada_dependencia->descripcion_llamada,
	       			]);
	       			if ($dependencia) {
                // Si creamos la dependencia la guardamos en la relacion
	       				$registro->dependencia_llamada()->save($dependencia);
	       			}
       			}
            // Si existe el arreglo de reportes
       			$reportes = json_decode($row->reporte_dependencias);
       			if (!empty($reportes) || !is_null($reportes)) {
              // Recorremos todo los reportes
       				foreach ($reportes as $reporte) {
       					var_dump($row->serie); 
                // creamos un reporte de dependencia
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
                // Y lo guardamos en la relacion
       					$registro->dependencia_reportes()->save($reporte_dependencia);
       				}
       			}
       			// Mostramos el registro guardado. Para fines de debug
       			var_dump($registro);

       		}
       	});
        // dd($query_rows[0]);
    }
}
