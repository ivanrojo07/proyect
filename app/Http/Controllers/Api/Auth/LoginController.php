<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    //Variables publicas del controlador
    public $http,$token_url,$client,$rules;

    public function __construct()
    {
        // inicializamos nuestras variables publicas
    	$this->token_url = url('/oauth/token');
    	$this->client = Client::find(2);
    	$this->http = new GuzzleClient;
    	$this->rules = [
    		'email' => 'required|string|email',
    		'password' => 'required|string'
    	];
    }

    // Ruta POST .../api/oauth/login
    public function login(Request $request){
        // Validamos el cliente que se va a autenticar
    	$request->validate($this->rules);
        // Creamos un arreglo con el email y password obtenido
    	$credenciales = request(['email','password']);
        // Si las credenciales no corresponden a los usuarios que estan en la base de datos
    	if (!Auth::attempt($credenciales)) {
            // Retornamos una respuesta json 401 sin autorizacion
    		return response()->json(['message'=>'Unauthorized'],401);
    	}
    	else{
            // Obtenemos el usuario logueado
    		$user = Auth::user();
            // Recorremos todos los tokens del usuario
    		foreach($user->tokens as $token){
                // Invalidamos todos sus tokens
    			$token->update(['revoked'=>true]);
    		}
            // Obtenemos el email y el password
    		$email = $request->email;
    		$password = $request->password;
            try {
                // peticion post la oauth para obtener un nuevo token 
                $response = $this->http->post(
                        $this->token_url,
                        [
                            'form_params'=>[
                                'grant_type' => 'password',
                                'client_id' => $this->client->id,
                                'client_secret' => $this->client->secret,
                                'username' => $email,
                                'password' => $password,
                                'scope' => ''
                            ]
                        ]);
                // mostramos la respuesta json que nos dio la peticion (incluye los tokens)
                return response()->json(['response'=>json_decode($response->getBody())],201);
            } catch (ClientException $e) {
                // Si el error contiene un response
                if ($e->hasResponse()) {
                    // Retornamos la response del error
                    return response()->json(['errors'=>$e->getResponse()],422);
                }
                else{
                    // Mostramos todo el error
                    return response()->json(['errors'=>$e],500);
                }
            }
    	}
    }
}
