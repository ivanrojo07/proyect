<?php

namespace App\Http\Controllers;

use App\Roles\Institucion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ModuloController extends Controller
{
    //

    public function __construct($body = null)
    {
    	$this->body = session('body');
    }


	public function showForm(Request $request){
		$body = $request->session()->get('body');
		if(!empty($body['claro360'])){
			$instituciones = Institucion::orderBy('nombre','asc')->get();
			return view('modulo.form',['instituciones'=>$instituciones]);
		}
		else{
			// Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
            return redirect('/login')->with('mensaje-error','Usuario no encontrado, por favor intente más tarde.');
		}
	}

	public function submitForm(Request $request)
	{
		$request->validate(['institucion' => "required|exists:institucions,id"]);
		$claro360 =  $request->session()->get('body.claro360');
		if(!empty($claro360)){
			$user = User::where('email',$claro360['correo'])->first();
			if ($user) {
				$user->institucion_id = $request->institucion;

			}else{
				$user = new User([
                            'nombre' => $claro360['nombre'],
                            "apellido_paterno" => $claro360["apellido_paterno"],
                            "apellido_materno" => $claro360["apellido_materno"],
                            "email" => $claro360['correo'],
                            // "claro_token" =>$claro360['token']

                        ]);
				$user->id = $claro360['id'];
				$user->institucion_id = $request->institucion;

			}
			$user->save();
			$modulo = [
	            "id360" => $claro360['id'],
	            "modulo" => "incidentes",
	            "institucion_id" => intval($user->institucion_id),
	            "activo" => '1'
	        ];
			$param_modulo = Http::post(env("USUARIOS_360_URL")."/registro_modulo",$modulo);
			// session()->flush();
			auth()->login($user,false);
            // Redirigimos al index
            return redirect()->route('home');
		}
		else{
			// Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
            return redirect('/login')->with('mensaje-error','Usuario no encontrado, por favor intente más tarde.');
		}
	}
}
