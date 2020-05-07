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
    //
	public function incidenteIndexReport(Request $request)
	{
		if ($request->fecha) {
			$validate =  Validator::make($request->all(),['fecha'=>'required|date|date_format:Y-m-d']);
			if ($validate->fails()) {
				return redirect()->route('incidente.index');
			}
			else{
				$date = Date($request->fecha);
			}
		}
		else{
			$date = Date('Y-m-d');
		}
		$institucion = Auth::user()->institucion;
		if ($institucion) {
			switch ($institucion->tipo_institucion) {
				case "Federal":
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->orderBy('hora_ocurrencia','asc')->paginate(7);
					break;

				case "Estatal":
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->whereIn('estado_id',$institucion->estados->pluck('id'))->orderBy('hora_ocurrencia','asc')->paginate(7);
					break;
				
				default:
					$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->whereIn('municipio_id',$institucion->municipios->pluck('id'))->orderBy('hora_ocurrencia','asc')->paginate(7);
					break;
			}

		}
		else{
			$registro_incidentes = null;

		}
		$pdf = PDF::loadView('pdf.index',['incidentes'=>$registro_incidentes,'fecha'=>$date, 'institucion' => $institucion])->setOrientation('landscape');
		return $pdf->inline("incidentes $date.pdf");

	}

    public function incidenteShowReport(RegistroIncidente $incidente)
    {

		// return view('pdf.incidente',['incidente'=>$incidente]);
		$user = Auth::user();
		$institucion = $user->institucion;
		$mostrar = false;
		if ($institucion) {
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
		if ($mostrar) {
			$dependencia = $incidente->dependencia_llamada;
			$reportes = $incidente->dependencia_reportes;
			$pdf = PDF::loadView('pdf.incidente',[
				'incidente'=>$incidente,
				'dependencia'=>$dependencia,
				'reportes'=>$reportes,
				'institucion' => $institucion
			]);
			// $pdf = PDF::loadFile('https://www.google.com');
	    	return $pdf->inline("incidente $incidente->id $incidente->fecha_ocurrencia $incidente->hora_ocurrencia.pdf");
			
		}
		else{
			return redirect()->route('incidente.index');
		}
    }
}
