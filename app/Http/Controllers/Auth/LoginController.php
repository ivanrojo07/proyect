<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Aplicamos un middleware que solo las rutas
        // Sean visibles si no estas logueado
        // (excepto el handler logout)
        $this->middleware('guest')->except('logout');
        // Obtenemos la url de la api
        $this->url = env("USUARIOS_360_URL");
        // La ruta para login
        $this->login_path = "/login";
        // ruta de access_token
        $this->get_access_token = "/access_token";
        // ruta de validación de access_token
        $this->validate_access_token = "/validate/access_token";
        // informacion de login claro auth 360 usuarios
        $this->usuario360 = [];
        // Modulos que pueden acceder
        $this->modulos360 = [
            "plataforma360" => null,
            "telemedicina_medico" => null,
            "telemedicina_paciente" => null,
            "facturacion" => null,
            "app360" => null,
            "mapagis" => null,
            "lineamientos" => null,
            "incidentes" => null,
            "plan_interno" => null,
            "videovigilancia" => null
        ];

    }

    /**
     * Login para plataforma incidentes
     *  
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback(Request $request){
        // Validamos el formulario 
        $request = $request->validate([
            'email' => "required|string",
            "password" => "required|string"
        ]);
        // Primero loguear con cuentas de claro 360 (para obtener modulos de plataformas)
        $logueo_360 = $this->loginUsuario360($request);
        // si logueo por claro 360 es correcta
        if ($logueo_360['login']) {
            // retornamos a la pagina home
            return  redirect()->route("home");
        }
        // Si no se puede loguear por usuarios 360, lo comparamos con nuestra bd
        else{
            // llamamos a la funcion login plataforma
            $logueo_local = $this->loginPlataforma($request);
            // si logueo exitoso
            if ($logueo_local['login']) {
                // Retornamos a home 
                return redirect()->route('home');
            }
            // Si no logueamos
            else{
                // retorna a login con error de usuario 360
                return redirect('/login')->with('mensaje-error',$logueo_360['mensaje-error']);
            }
        }
    }

    public function loginPlataforma($request)
    {
        // Obtenemos email y password
        $email = $request["email"];
        $password = $request["password"];

        // Verificar si el usuario y contraseña coincide
        if (Auth::attempt(array("email"=>$email, "password" => $password))) {
            // Logeamos el usuario en la plataforma
            $user = User::where('email',$request['email'])->first();
            // nos logueamos con el usuario con el email
            auth()->login($user,false);
            // El token aún es valido. Redirigimos al inicio.
            return ['login'=>true];

        }
        else{
            // Usuario y contraseña son invalidos. 
            // Retornamos al login con mensajes del evento.
            return ['login'=>false];
        }
    }

    public function loginUsuario360($request)
    {
        // Usando api de usuarios 360
        $response = Http::post($this->url.$this->login_path,[
            "correo" => $request['email'],
            "contrasenia" => $request['password']
        ]);
        // Si status code es 200
        if ($response->ok()) {
            // Obtenemos la respuesta en formato json
            $body = $response->json();
            // si la llave success es true
            if ($body['success']) {
                // Si el modulo de incidentes es vacio enn el cuerpo
                if(empty($body["incidentes"])){
                    // Retornamos el login en falso con un mensaje de error
                    return ["login"=> false, "mensaje-error" => "No tienes acceso a esta plataforma, verifica tu plan."];
                }
                // De lo contrario
                else{
                    // dd($body['incidentes'][0]['activo']);
                    if ($body['incidentes'][0]['activo'] == "1") {
                        
                        // Obtenemos el usuario
                        $claro360_user = $body["claro360"];
                        // verificamos que el usuario exista en nuestra bd
                        $existingUser = User::where("email",$claro360_user["correo"])->first();
                        // Si existe y su contraseña 
                        if ($existingUser && !empty($existingUser->password)) {
                            // Verificammos que usuario y contraseña coincidan
                            if (Auth::attempt(array("email"=>$request['email'], "password" => $request['password']))) {
                                // Logeamos el usuario en la plataforma
                                auth()->login($existingUser,false);
                                // mandamos a la función setsession con body
                                $this->setSessionJSON($body);
                                // guardamos el token resultado
                                $existingUser->claro_token = $claro360_user['token'];
                                // guardamos los cambios
                                $existingUser->save();

                                // Mandamos login a true.
                                return ['login' => true];

                            }
                            else{
                                // mandamos func setsession con body
                                $this->setSessionJSON($body);
                                // guardamos token, nueva contraseñaaa y guardamos
                                $existingUser->claro_token = $claro360_user['token'];
                                $existingUser->password = Hash::make($request['password']);
                                $existingUser->save();
                                // loggeamos a usuario
                                auth()->login($existingUser,false);
                                // retornamos login true
                                return ['login'=> true];
                            }
                            // return $this->loginPlataforma($existingUser,$request);
                        }
                        // Si existe usuario pero su contraseña es vacia
                        else if($existingUser && empty($existingUser->password)){
                            // mandamos set   session con body
                            $this->setSessionJSON($body);
                            // guardamos token, password, y guardamos
                            $existingUser->claro_token = $claro360_user['token'];
                            $existingUser->password = Hash::make($request['password']);
                            $existingUser->save();
                            // Loooogeamosssss a usuario
                            auth()->login($existingUser,false);
                            // Retornamos login a true
                            return ['login' => true];
                        }
                        else{
                            // Crear nuevo usuario
                            $newUser = New User([
                                'nombre' => $claro360_user['nombre'],
                                "apellido_paterno" => $claro360_user["apellido_paterno"],
                                "apellido_materno" => $claro360_user["apellido_materno"],
                                "email" => $claro360_user['correo'],
                                "password" => Hash::make($request['password']),
                                'claro_token' => $claro360_user['token']
                            ]);
                            // dd($body["incidentes"][0]['institucion_id']);
                            $newUser->id = $claro360_user['id'];
                            $newUser->institucion_id = $body["incidentes"][0]['institucion_id'];
                            $newUser->save();
                            // mandamos setsession con body
                            $this->setSessionJSON($body);
                            // logeamos a usuario
                            auth()->login($newUser,false);
                            // retornamos true el login
                            return ['login'=>true];
                        }
                    }
                    else{
                        return ['login'=>false, "mensaje-error"=>"El modulo todavía no se encuentra activo"];
                    }
                }
                
            }
            // de lo contrario
            else{
                // mandamos login false con mensaje
                return ['login'=>false,'mensaje-error'=>"Usuario o contraseña incorrectos"];
            }
        }
        else{
            // Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
            return redirect('/login')->with('mensaje-error','Usuario no encontrado, por favor intente más tarde.');
        }
    }

    public function getAccessToken(Request $request)
    {

        $token = $request->token;
        $user_id = $request->user_id;
        $response = Http::post($this->url.$this->get_access_token,[
            "token" => "$token",
            "id360" => "$user_id" 
        ]);
        if ($response->ok()) {
            $content = $response->json();
            if ($content["success"]) {
                // Obtenemos el access token de la respuesta
                $access_token = $content["access_token"];
                return response()->json(['id360'=>$user_id,"access_token"=>$access_token],201);
            }
            else{
                 // Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
                return response()->json(['error'=>"token o id incorrecto"],403);
            }
        }else{
            // Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
            return response()->json(['error'=>"no se pudo comunicar con el servidor, intente mas tarde"],403);
        }
    }

    public function verificaCuenta360($user_id,$access_token)
    {
        $response = Http::post($this->url.$this->validate_access_token,[
            "id360" => $user_id,
            "access_token" => $access_token
        ]);

        if ($response->ok() ) {
            $body = $response->json();
            // dd($body);
            if ($body["success"]) {
                $claro360 = $body["claro360"];
                $this->setSessionJSON($body);
                if (!empty($body["incidentes"])) {
                    $this->setSessionJSON($body);
                    
                    $existingUser = User::where("email",$claro360["correo"])->first();
                    if ($existingUser) {
                        $existingUser->claro_token = $claro360['token'];
                        $existingUser->save();
                        auth()->login($existingUser,false);
                        return redirect()->route("home");
                    }
                    else{
                        // Crear nuevo usuario
                        $newUser = new User([
                            'nombre' => $claro360['nombre'],
                            "apellido_paterno" => $claro360["apellido_paterno"],
                            "apellido_materno" => $claro360["apellido_materno"],
                            "email" => $claro360['correo'],
                            // "claro_token" =>$claro360['token']

                        ]);
                        // dd($body["incidentes"][0]['institucion_id']);
                        $newUser->id = $claro360['id'];
                        $newUser->institucion_id = $body["incidentes"][0]['institucion_id'];
                        $newUser->save();

                        auth()->login($newUser,false);
                        return redirect()->route("home");

                    }
                    
                }
                else{
                    // Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
                    session(['body'=>$body]);
                    return redirect()->route('registrar_modulo');
                }
            }
            else{
                // Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
                return redirect('/login')->with('mensaje-error',$body["mensaje"]);
            }
        }
        else{
            // Si la api falla redirigimos al login con el mensaje de que lo intente más tarde.
            return redirect('/login')->with('mensaje-error','Usuario no encontrado, por favor intente más tarde.');
        }
    }

    public function setSessionJSON($response)
    {
        $this->claro360 = $response['claro360'];

        if (!empty($response['plataforma360'])) {

            $this->modulos360['plataforma360'] = $this->limpiarPlataforma($response['plataforma360']);
        }
        if (!empty($response['telemedicina_medico'])) {
            $this->modulos360['telemedicina_medico'] = $response['telemedicina_medico'][0];
        }
        if (!empty($response['telemedicina_paciente'])) {
            $this->modulos360['telemedicina_paciente'] = $response['telemedicina_paciente'][0];
        }
        if (!empty($response['facturacion'])) {
            $this->modulos360['facturacion'] = $response['facturacion'][0];
        }
        if (!empty($response['app360'])) {
            $this->modulos360['app360'] = $response['app360'][0];
        }
        if (!empty($response['mapagis'])) {
            $this->modulos360['mapagis'] = $response['mapagis'][0];
        }
        if (!empty($response['lineamientos'])) {
            $this->modulos360['lineamientos'] = $response['lineamientos'][0];
        }
        if (!empty($response['incidentes'])) {
            $this->modulos360['incidentes'] = $response['incidentes'][0];
        }
        if (!empty($response['plan_interno'])) {
            $this->modulos360['plan_interno'] = $response['plan_interno'][0];
        }
        if (!empty($response['videovigilancia'])) {
            $this->modulos360['videovigilancia'] = $response['videovigilancia'][0];
        }

        session(['claro360' => $this->claro360]);
        session(['modulos360' => $this->modulos360]);

    }

    public function limpiarPlataforma($res)
    {
        // Array temporal
        $array_temp = [];
        // Recorremos el arreglo
        foreach ($res as $plataforma) {
            // (funcion array_search: busca la similitud de un string en el arreglo; array_column: busca dentro el arreglo las llaves alias) verifica que el alias no este en nuestro arreglo
            if(array_search($plataforma['alias'],array_column($array_temp,'alias')) === false){
                // de no estarlo agregamos el objeto al arreglo
                array_push($array_temp,$plataforma);
            }
        }
        // Retornamos el array
        return $array_temp;
    }
}
