<?php

namespace App\Http\Controllers\Api\Estado;

use App\CodigoPostal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
     /**
     * Show the profile for the given user.
     *
     * @param  string  $codigo_postal
     * @return View
     */
    public function __invoke($codigo_postal)
    {
    	$res = CodigoPostal::where('codigo',$codigo_postal)->get();
    	if (count($res) > 0) {
    		return response()->json(['response'=>$res],200);
    	}
    	else{
    		return response()->json(['response'=>null],404);
    	}
    }
}
