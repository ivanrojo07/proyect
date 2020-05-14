<?php

namespace App\Http\Controllers\Pdf;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Incidente\RegistroIncidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;

class IncidentePdfController extends Controller
{
    // Ruta GET ../pdf/incidente
	public function incidenteIndexReport(Request $request)
	{
		// Si existe request fecha
		if ($request->fecha) {
			// Validamos que sea una fecha valida
			$validate =  Validator::make($request->all(),['fecha'=>'required|date|date_format:Y-m-d']);
			// Si la validacion falla
			if ($validate->fails()) {
				// Redirigos al index
				return redirect()->route('incidente.index');
			}
			else{
				//Creamos la fecha
				$date = Date($request->fecha);
			}
		}
		else{
			// Obtenemos la fecha de hoy
			$date = Date('Y-m-d');
		}
		// Obtenemos la institucion del usuario
		$institucion = Auth::user()->institucion;
		if ($institucion) {
			// Obtenemos los registros de incidentes de esa fecha correspondiente a los estados de la institucion
			switch ($institucion->tipo_institucion) {
				case "Federal":
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->orderBy('hora_ocurrencia','asc')->get();
					break;

				case "Estatal":
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('hora_ocurrencia','asc')->get();
					break;
				
				default:
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('hora_ocurrencia','asc')->get();
					break;
			}

		}
		else{
			// Si no existe institucion registro es nulo
			$registro_incidentes = null;

		}
		// Creamos el pdf con laravel snappy
		$pdf = PDF::loadView('pdf.index',['incidentes'=>$registro_incidentes,'fecha'=>$date, 'institucion' => $institucion])->setOrientation('landscape');
		// Retornamos el pdf
		return $pdf->inline("incidentes $date.pdf");

	}

    public function incidenteShowReport(RegistroIncidente $incidente)
    {

		// Obtenemos el usuario
		$user = Auth::user();
		// La institucion del usuario
		$institucion = $user->institucion;
		// booleano que indica si se mostrara o no el incidente
		$mostrar = false;
		// Si existe institucion
		if ($institucion) {
			// Verificamos que tipo de institucion puede ver este reporte
			switch ($institucion->tipo_institucion) {
				case "Federal":
					$mostrar = true;
					break;

				case "Estatal":
					$estado_incidente = $incidente->estado;
					$mostrar = $institucion->estados()->where('regionable_id',$estado_incidente->id)->exists();
					break;
				
				default:
					$estado_incidente = $incidente->estado;
					$municipios_id = $institucion->municipios()->pluck('regionable_id');
					$mostrar = Estado::whereIn('id',$institucion->municipios()->pluck('estado_id'))->where('id',$estado_incidente->id)->exists();
					break;
			}
			
		}
		// si mostrar es verdadero
		if ($mostrar) {
			// obtenemos la llamad a dependencia, y los reportes
			$dependencia = $incidente->dependencia_llamada;
			$reportes = $incidente->dependencia_reportes;
			// Creamos el pdf con la informacion
			$pdf = PDF::loadView('pdf.incidente',[
				'incidente'=>$incidente,
				'dependencia'=>$dependencia,
				'reportes'=>$reportes,
				'institucion' => $institucion
			]);
			// Y lo mostramos
	    	return $pdf->inline("incidente $incidente->id $incidente->fecha_ocurrencia $incidente->hora_ocurrencia.pdf");
			
		}
		else{
			// De lo contrario, regresamos al index
			return redirect()->route('incidente.index');
		}
    }
}
