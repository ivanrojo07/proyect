<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Roles\Institucion;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public $usuario_360_url, $registro_usuario, $asignar_modulo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->usuario_360_url = env("USUARIOS_360_URL");
        $this->registro_usuario = "/registro";
        $this->asignar_modulo = "/registro_modulo";
    }

    public function form()
    {
        // Obtenemos todas las instituciones de la base de datos
        $instituciones = Institucion::orderBy('nombre','asc')->get();
        /*retornamos la vista al formulario con las instituciones 
            y una bandera para que sea el formulario de guardado de usuario*/
        return view('auth.crear_usuario',['instituciones'=>$instituciones]);
    }
    public function registrar(Request $request)
    {
        $rules = [
            'nombre' => "required|string|max:255",
            'apellido_paterno' => "required|string|max:255",
            'apellido_materno' => "nullable|string|max:255",
            'institucion' => "required|exists:institucions,id",
            'email' => "required|string|email|max:255|unique:users",
            'password' => "required|string|min:8|confirmed"
        ];
        $request->validate($rules);

        // Obbtenemos el parametros de un nuevo usuario
        $registro_usuario_param = $this->setParamNewUsuario($request);
        // dd($registro_usuario_param);
        $response = Http::post($this->usuario_360_url.$this->registro_usuario,$registro_usuario_param);
        if ($response->ok()) {
            $body = $response->json();
            if ($body["success"]) {
                // Registrar modulo en claro 360
                $registro_modulo_param = $this->setParamModulo($body["id360"],$request->institucion,"1");
                $res_modulo = Http::post($this->usuario_360_url.$this->asignar_modulo,$registro_modulo_param);
                $body_modulo = $res_modulo->json();
                if ($res_modulo->ok() && $body_modulo["success"]) {
                    // Creamos un modelo usuario
                    $user = User::create([
                        'nombre' => $request->nombre,
                        'apellido_paterno' => $request->apellido_paterno,
                        'apellido_materno' => $request->apellido_materno,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
                    $user->id = $body["id360"];
                    // Buscamos la institucion con el íd dado
                    $institucion = Institucion::find($request->institucion);
                    // Y lo asociamos con el usuario
                    $user->institucion()->associate($institucion);
                    // Grabamos el modelo en la bd
                    $user->save();
                    auth()->login($user,false);
                    // Redirigimos al index
                    return redirect()->route('home');
                }
                else{
                    return redirect()->route("registrar_form")->with("mensaje-error","No se asigno el modulo");
                }
                
            }
            else if ($body["failure"]) {
                return redirect()->route("registrar_form")->with("mensaje-error",$body['mensaje']);
            }
            else{
                return redirect()->route("registrar_form")->with("mensaje-error","Error con en el servidor con la creación de usuarios 360");
            }
        }
        else{
            return redirect()->route("registrar_form")->with("mensaje-error","Error con en el servidor con la creación de usuarios 360");
        }
        
    }

    

    public function setParamNewUsuario($data)
    {
        return [
            "correo" => $data["email"],
            "nombre" => $data["nombre"],
            "apellido_paterno" => $data["apellido_paterno"],
            "apellido_materno" => $data["apellido_materno"],
            "contrasenia" => $data["password"]
        ];
    }
    public function setParamModulo($id360, $institucion_id,$activo)
    {
        return [
            "id360" => "$id360",
            "modulo" => "incidentes",
            "institucion_id" => intval($institucion_id),
            "activo" => $activo
        ];
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido_paterno' => ['required', 'string', 'max:255'],
            'apellido_materno' => ['nullable', 'string', 'max:255'],
            'tipo_catalogo' => ['nullable', 'string', 'in:,proteccion civil,incidente'],
            'estado' => ['nullable', 'numeric'],
            'municipio' => ['nullable', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'tipo_catalogo' => $data['tipo_catalogo'],
            'id_edo' => $data['estado'],
            'id_mun' => $data['municipio'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
