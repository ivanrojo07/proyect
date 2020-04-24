<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Incidente\RegistroIncidente;
use Illuminate\Http\Request;

class IncidentePdfController extends Controller
{
    //
    public function incidenteReport(RegistroIncidente $incidente)
    {


    	$pdf = \PDF::loadFile('hola');
    	return $pdf->inline('hola.pdf');
    }
}
