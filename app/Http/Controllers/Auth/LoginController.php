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
        $this->middleware('guest')->except('logout');
        $this->url = env("USUARIOS_360_URL");
        $this->login_path = "/login";
        $this->get_access_token = "/access_token";
        $this->validate_access_token = "/validate/access_token";

        $this->usuario360 = [];
        $this->modulos360 = [
            "plataforma360" => null,
            "telemedicina_medico" => null,
            "telemedicina_paciente" => null,
            "facturacion" => null,
            "app360" => null,
            "mapagis" => null,
            "lineamientos" => null,
            "incidentes" => null,
            "plan_interno" => null
        ];

    }

    /**
     * Login para plataforma incidentes
     *  
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback(Request $request){
        $request = $request->validate([
            'email' => "required|string",
            "password" => "required|string"
        ]);
        // return $this->loginUsuario360($request);
        // Verificamos si el usuario existe en la base de datos local
        $existingUser = User::where('email',$request['email'])->first();
        // Si existe en local, logeamos desde la plataforma
        if ($existingUser && !empty($existingUser->password)) {
            return $this->loginPlataforma($existingUser,$request);
        }
        else{
            // De lo contrario logeamos por api usuarios 360
            return $this->loginUsuario360($request);
        }
    }

    public function loginPlataforma(User $user, $request)
    {
        $email = $request["email"];
        $password = $request["password"];

        // Verificar si el usuario y contraseña coincide
        if (Auth::attempt(array("email"=>$email, "password" => $password))) {
            // Logeamos el usuario en la plataforma
            auth()->login($user,false);
            // El token aún es valido. Redirigimos al inicio.
            return redirect()->route('home');

        }
        else{
            // Usuario y contraseña son invalidos. 
            // Retornamos al login con mensajes del evento.
            return redirect('/login')->with('mensaje-error','Usuario o contraseña incorrecta');
        }
    }

    public function loginUsuario360($request)
    {
        // Usando api de usuarios 360
        $response = Http::post($this->url.$this->login_path,[
            "correo" => $request['email'],
            "contrasenia" => $request['password']
        ]);
        if ($response->ok()) {
            $body = $response->json();
            // dd($body);

            if ($body['success']) {
                $this->setSessionJSON($body);
                if(empty($body["incidentes"])){
                    return redirect('/login')->with('mensaje-error',"No tienes acceso a esta plataforma, verifica tu plan.");
                }
                else{
                    $claro360_user = $body["claro360"];
                    $existingUser = User::where("email",$claro360_user["correo"])->first();
                    if ($existingUser && !empty($existingUser->password)) {
                        if (Auth::attempt(array("email"=>$request['email'], "password" => $request['password']))) {
                            // Logeamos el usuario en la plataforma
                            auth()->login($existingUser,false);
                            // El token aún es valido. Redirigimos al inicio.
                            return redirect()->route('home');

                        }
                        // return $this->loginPlataforma($existingUser,$request);
                    }
                    else if($existingUser && empty($existingUser->password)){
                        $existingUser->password = Hash::make($request['password']);
                        $existingUser->save();
                        auth()->login($existingUser,false);
                    }
                    else{
                        // Crear nuevo usuario
                        $newUser = New User([
                            'nombre' => $claro360_user['nombre'],
                            "apellido_paterno" => $claro360_user["apellido_paterno"],
                            "apellido_materno" => $claro360_user["apellido_materno"],
                            "email" => $claro360_user['correo'],
                            "password" => Hash::make($request['password'])
                        ]);
                        // dd($body["incidentes"][0]['institucion_id']);
                        $newUser->id = $claro360_user['id'];
                        $newUser->institucion_id = $body["incidentes"][0]['institucion_id'];
                        $newUser->save();

                        auth()->login($newUser,false);
                        return redirect()->route("home");
                    }
                }
                
            }
            else{
                return redirect('/login')->with('mensaje-error',$body["mensaje"]);
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
                if (!empty($body["incidentes"])) {
                    $this->setSessionJSON($body);
                    
                    $existingUser = User::where("email",$claro360["correo"])->first();
                    if ($existingUser) {
                        auth()->login($existingUser,false);
                        return redirect()->route("home");
                    }
                    else{
                        // Crear nuevo usuario
                        $newUser = new User([
                            'nombre' => $claro360['nombre'],
                            "apellido_paterno" => $claro360["apellido_paterno"],
                            "apellido_materno" => $claro360["apellido_materno"],
                            "email" => $claro360['correo']

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
                    return redirect('/login')->with('mensaje-error','No tienes acceso a esta plataforma, verifica tu plan.');
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
            $this->modulos360['plataforma360'] = $response['plataforma360'][0];
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

        session(['claro360' => $this->claro360]);
        session(['modulos360' => $this->modulos360]);

    }
}
