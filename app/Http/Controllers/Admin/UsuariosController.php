<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Roles\Institucion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UsuariosController extends Controller
{
    public $usuario_360_url, $registro_usuario, $asignar_modulo;

    public function __construct()
    {
        $this->usuario_360_url = env("USUARIOS_360_URL");
        $this->registro_usuario = "/registro";
        $this->asignar_modulo = "/registro_modulo";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = strtolower($request->search);
        // Obtenemos todos los usuarios con o sin request de search
        $usuarios = $search ? User::where("nombre","LIKE","%$search%")
                                    ->orWhere("apellido_paterno","LIKE","%$search%")
                                    ->orWhere("apellido_materno","LIKE","%$search%")
                                    ->orWhere("email","LIKE","%$search%")
                                    ->get()
                            : User::orderBy('id','asc')->get();
        // Retornamos la vista index
        return view('admin.usuario.index',['usuarios'=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtenemos todas las instituciones de la base de datos
        $instituciones = Institucion::orderBy('nombre','asc')->get();
        /*retornamos la vista al formulario con las instituciones 
            y una bandera para que sea el formulario de guardado de usuario*/
        return view('admin.usuario.form',['instituciones'=>$instituciones,'edit'=>false]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creamos las reglas de validación de este formulario
        $rules = [
            'nombre' => "required|string|max:255",
            'apellido_paterno' => "required|string|max:255",
            'apellido_materno' => "nullable|string|max:255",
            'email' => "required|string|email|max:255|unique:users",
            'password' => "required|string|min:8|confirmed",
            'institucion' => "nullable|numeric|exists:institucions,id"
        ];
        // Validamos el request con las reglas
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
                    // Redirigimos al index
                    return redirect()->route('admin.usuarios.index')->with('mensaje',$body['mensaje']);
                }
                else{
                    return redirect()->route("admin.usuarios.index")->with("mensaje","No se asigno el modulo");
                }
                
            }
            else if ($body["failure"]) {
                return redirect()->route("admin.usuarios.index")->with("mensaje",$body['mensaje']);
            }
            else{
                return redirect()->route("admin.usuarios.index")->with("mensaje","Error con en el servidor con la creación de usuarios 360");
            }
        }
        else{
            return redirect()->route("admin.usuarios.index")->with("mensaje","Error con en el servidor con la creación de usuarios 360");
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        // Retornamos la vista show con el usuario 
        return view('admin.usuario.show',['usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        // obtenemos las instituciones de la base de datos
        $instituciones = Institucion::orderBy('nombre','asc')->get();
        /*Retornamos la vista form con las instituciones, el usuario a editar
            Y una bandera para señalar que muestre el formulario para editar un usuario*/
        return view('admin.usuario.form',['instituciones'=>$instituciones,'edit'=>true,'user'=>$usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        // Establecemos las reglas de validacion para el formulario
        $rules = [
            'nombre' => "required|string|max:255",
            'apellido_paterno' => "required|string|max:255",
            'apellido_materno' => "nullable|string|max:255",
            'email' => "required|string|email|max:255|unique:users,email,".$usuario->id,
            'password' => "nullable|string|min:8|confirmed",
            'institucion' => "nullable|numeric|exists:institucions,id"
        ];
        // Validamos el request con las reglas de validacion
        $request->validate($rules);
        // Actualizamos el usuario con los nuevos parametros
        $usuario->update([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
        ]);
        // Si existe password
        if ($request->password) {
            // Creamos el password del usuario con el request hasheado
            $usuario->password = Hash::make($request->password);
        }
        // Obtenemos la institucion con el id del parametro
        $institucion = Institucion::find($request->institucion);
        // Y lo asociamos a la relacion con el usuario
        $usuario->institucion()->associate($institucion);
        // Guardamos estos cambios
        $usuario->save();
        // Redirigimos al index
        return redirect()->route('admin.usuarios.index')->with('mensaje','Se actualizo un usuario');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
         // Registrar modulo en claro 360
        $registro_modulo_param = $this->setParamModulo($usuario->id,$usuario->institucion_id,"0");
        // solicitud http
        $res_modulo = Http::post($this->usuario_360_url.$this->asignar_modulo,$registro_modulo_param);
        $body_modulo = $res_modulo->json();
        if ($res_modulo->ok() && $body_modulo["success"]) {
            // Eliminamos al usuario
            $usuario->delete();
            // Redirigimos al index 
            return redirect()->route('admin.usuarios.index')->with('mensaje',"Se elimino el usuario correctamente");
        }
        else{
            return redirect()->route('admin.usuarios.index')->with('mensaje',"Se elimino el usuario correctamente");
        }
    }
}
