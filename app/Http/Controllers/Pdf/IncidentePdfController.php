<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Incidente\RegistroIncidente;
use Illuminate\Http\Request;
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
		$registro_incidentes = RegistroIncidente::where('fecha_ocurrencia',$date)->orderBy('hora_ocurrencia','asc')->get();
		$pdf = PDF::loadView('pdf.index',['incidentes'=>$registro_incidentes,'fecha'=>$date])->setOrientation('landscape');
		return $pdf->inline("incidentes $date.pdf");

	}

    public function incidenteShowReport(RegistroIncidente $incidente)
    {

		// return view('pdf.incidente',['incidente'=>$incidente]);
		$dependencia = $incidente->dependencia_llamada;
		$reportes = $incidente->dependencia_reportes;
		$pdf = PDF::loadView('pdf.incidente',[
			'incidente'=>$incidente,
			'dependencia'=>$dependencia,
			'reportes'=>$reportes
		]);
		// $pdf = PDF::loadFile('https://www.google.com');
    	return $pdf->inline("incidente $incidente->id $incidente->fecha_ocurrencia $incidente->hora_ocurrencia.pdf");
    }
}
