<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Roles\Institucion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = User::orderBy('id','asc')->paginate(7);
        return view('admin.usuario.index',['usuarios'=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $instituciones = Institucion::orderBy('nombre','asc')->get();
        return view('admin.usuario.form',['instituciones'=>$instituciones,'edit'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'nombre' => "required|string|max:255",
            'apellido_paterno' => "required|string|max:255",
            'apellido_materno' => "nullable|string|max:255",
            'email' => "required|string|email|max:255|unique:users",
            'password' => "required|string|min:8|confirmed",
            'institucion' => "nullable|numeric|exists:institucions,id"
        ];
        $request->validate($rules);
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $institucion = Institucion::find($request->institucion);
        $user->institucion()->associate($institucion);
        $user->save();
        return redirect()->route('admin.usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //
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
        //
        $instituciones = Institucion::orderBy('nombre','asc')->get();
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
        //
        $rules = [
            'nombre' => "required|string|max:255",
            'apellido_paterno' => "required|string|max:255",
            'apellido_materno' => "nullable|string|max:255",
            'email' => "required|string|email|max:255|unique:users,email,".$usuario->id,
            'password' => "nullable|string|min:8|confirmed",
            'institucion' => "nullable|numeric|exists:institucions,id"
        ];
        $request->validate($rules);
        $usuario->update([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
        ]);
        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }
        $institucion = Institucion::find($request->institucion);
        $usuario->institucion()->associate($institucion);
        $usuario->save();
        return redirect()->route('admin.usuarios.index');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        //
        $usuario->delete();
        return redirect()->route('admin.usuarios.index');
    }
}
