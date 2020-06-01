<?php

namespace App\Http\Controllers\Admin;

use App\Estado;
use App\Http\Controllers\Controller;
use App\Incidente\CategoriaIncidente;
use App\Roles\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //
        $search = strtolower($request->search);
        $instituciones = $search ?
                         Institucion::where("nombre","LIKE", "%$search%")->get()
                          : Institucion::orderBy('nombre','asc')->get();
        return view('admin.institucion.index',['instituciones'=>$instituciones]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtenemos los Estados de la base de datos
        $estados = Estado::orderBy('nombre','asc')->get();
        // Obtenemos la categoria incidente de la base de datos
        $categorias_incidente = CategoriaIncidente::orderBy('nombre','asc')->get();
        // Retornamos una vista inyectando nuestras variables
        return view('admin.institucion.create_form',['estados'=>$estados,'categorias_incidente'=>$categorias_incidente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Reglas de validacion para el formulario
        $rules = [
            'nombre' => "required|string|max:120",
            'header_1' => "required|image",
            'header_2' => "nullable|image",
            'favicon' => "nullable|image",
            'footer' => "nullable|image",
            'tipo_institucion' => "required|in:Estatal,Municipal,Federal",
            'estado' => "nullable|required_if:tipo_institucion,Municipal",
            'estados.*' => "nullable|required_if:tipo_institucion,Estatal|exists:estados,id",
            'municipios.*' => "nullable|required_if:tipo_institucion,Municipal|exists:municipios,id,estado_id,{$request->estado}",
            'categorias.*' => "required|numeric|exists:categoria_incidentes,id",

        ];
        // validamos el request
        $request->validate($rules);
        // verificamos si header_1 es archivo valido
        if ($request->file('header_1')) {
            // Lanzamos el handler para que guarde las imagenes en el storage y obtenemos su path
            $path_imagen_header = $this->uploadImage($request->file("header_1"));
        } else {
            // retornamos al formulario
            return redirect()->route('admin.institucion.create')->with('mensaje','Se necesita una imagen de la institución');
        }

        // verificamos si header_2 es archivo valido
        if ($request->file('header_2')) {
            // Guardamos la imagen en storage y obtenemos su path
            $path_imagen_header2 = $this->uploadImage($request->file('header_2'));
        } else {
            // mandamos el path como nulo
            $path_imagen_header2 = null;
        }
        // verificamos si favicon es archivo valido
        if ($request->file('favicon')) {
            // guardamos en el storage y obtenemos el path
            $path_imagen_favicon = $this->uploadImage($request->file('favicon'));
        } else {
            // retornamos el null
            $path_imagen_favicon = null;
        }
        // verificamos si footer es archivo valido
        if ($request->file('footer')) {
            // Guardamos en el storage y obtenemos el path
            $path_imagen_footer = $this->uploadImage($request->file('footer'));
        } else {
            // retornamos null 
            $path_imagen_footer = null;
        }
        // Creamos el objeto institucion 
        $institucion = new Institucion([
            'nombre' => $request->nombre,
            'tipo_institucion' => $request->tipo_institucion,
            'path_imagen_header' => $path_imagen_header,
            'path_imagen_header2' => $path_imagen_header2,
            'path_imagen_favicon' => $path_imagen_favicon,
            'path_imagen_footer' => $path_imagen_footer
        ]);
        // Guardamos la institución 
        $institucion->save();
        // Guardamos las relaciones para categorias incidentes
        $institucion->categorias_incidente()->attach($request->categorias);
        // Verificamos el tipo de institucion
        switch ($request->tipo_institucion) {
            // Si es federal
            case "Federal":
                // obtenemos todos los estados
                $estados = Estado::get();
                // Y lo guardamos en la relacion
                $institucion->estados()->saveMany($estados);
                break;

            // si es estatal
            case "Estatal":
                // guardamos en la relacion estados
                $institucion->estados()->attach($request->estados);
                break;

            // si es municipal
            case "Municipal":
                // guardamos en la relacion municipios
                $institucion->municipios()->attach($request->municipios);
                break;
            
        }
        // redirecciona al index
        return redirect()->route('admin.institucion.index')->with('mensaje','Se creo la institución '.$institucion->nombre);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show(Institucion $institucion)
    {
        // Obtenemos la vista de la institucion a mostrar.
        return view('admin.institucion.show',['institucion'=>$institucion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Institucion $institucion)
    {
        // Obtenemos los estados de la republica 
        $estados = Estado::orderBy('nombre','asc')->get();
        // Obtenemos todas las categorias del incidentes
        $categorias_incidente = CategoriaIncidente::orderBy('nombre','asc')->get();
        // Retornamos la vista con las variables inyectadas
        return view('admin.institucion.edit_form',[
            'institucion'=>$institucion, 
            'estados' => $estados, 
            'categorias_incidente' => $categorias_incidente
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institucion $institucion)
    {
        // Creamos las reglas de validacion para este formulario
        $rules = [
            'nombre' => "required|string|max:120",
            'header_1' => "nullable|image",
            'header_2' => "nullable|image",
            'favicon' => "nullable|image",
            'footer' => "nullable|image",
            'tipo_institucion' => "required|in:Estatal,Municipal,Federal",
            'estado' => "nullable|required_if:tipo_institucion,Municipal",
            'estados.*' => "nullable|required_if:tipo_institucion,Estatal|exists:estados,id",
            'municipios.*' => "nullable|required_if:tipo_institucion,Municipal|exists:municipios,id,estado_id,{$request->estado}",
            'categorias.*' => "required|numeric|exists:categoria_incidentes,id",

        ];
        // Validamos el request con las reglas
        $request->validate($rules);
        // verificamos si header_1 es archivo valido
        if ($request->file('header_1')) {
            // Guardamos la imagen y obtenemos el path
            $path_imagen_header = $this->uploadImage($request->file("header_1"));
            // Si existe path
            if ($path_imagen_header) {
                // Eliminamos el archivo anterior
                Storage::disk('public')->delete($institucion->path_imagen_header);
                // guardamos el nuevo path en el modelo
                $institucion->path_imagen_header = $path_imagen_header;
            }
        } 

        // verificamos si header_2 es archivo valido
        if ($request->file('header_2')) {
            // Guardamos las imagen y obtenemos el path
            $path_imagen_header2 = $this->uploadImage($request->file('header_2'));
            // Si existe el path de la imagen guardada
            if ($path_imagen_header2) {
                // Borramos el archivo anterior
                Storage::disk('public')->delete($institucion->path_imagen_header2);
                // guardamos el nuevo path en el modelo
                $institucion->path_imagen_header2 = $path_imagen_header2;
            }
        } 
        // verificamos si favicon es archivo valido
        if ($request->file('favicon')) {
            // Guardamos la imagen y obtenemos el path
            $path_imagen_favicon = $this->uploadImage($request->file('favicon'));
            // Si existe el path imagen 
            if ($path_imagen_favicon) {
                // Borramos el archivo anterior
                Storage::delete('public')->delete($institucion->path_imagen_favicon);
                // Guardamos el nuevo path en el modelo
                $institucion->path_imagen_favicon = $path_imagen_favicon;
            }
        } 
        // verificamos si footer es archivo valido
        if ($request->file('footer')) {
            // Guardamos la imagen en el storage y obtenemos el path
            $path_imagen_footer = $this->uploadImage($request->file('footer'));
            // Si existe el path
            if ($path_imagen_footer) {
                // Eliminamos el archivo anterior en el storage
                Storage::disk('public')->delete($institucion->path_imagen_favicon);
                // Guardamos el nuevo path en el modelo
                $institucion->path_imagen_footer = $path_imagen_footer;
            }
        }
        // Guardamos el nuevo nombre en el modelo
        $institucion->nombre = $request->nombre;
        // Guardamos el nuevo tipo de institucion en el modelo
        $institucion->tipo_institucion = $request->tipo_institucion;
        // Guardamos los cambios
        $institucion->save();
        // eliminando las relaciones con estados
        $institucion->estados()->detach();
        // Eliminando  las relaciones con municipios
        $institucion->municipios()->detach();
        // Actualizando nuevas relaciones
        $institucion->categorias_incidente()->attach($request->categorias);
        // Verificamos el tipo de institucion
        switch ($request->tipo_institucion) {
            // Si es una entidad federal
            case "Federal":
                // Obtenemos todos los estados
                $estados = Estado::get();
                // Y guardamos sus relaciones en la tabla pivote regionables
                $institucion->estados()->saveMany($estados);
                break;
            // Si es una entidad estatal
            case "Estatal":
                // Atamos las relaciones como estados en la tabla pivote regionables
                $institucion->estados()->attach($request->estados);
                break;
            // Si es una entidad Municipal
            case "Municipal":
                // Atamos las relaciones como municipios en la tabla pivote regionables 
                $institucion->municipios()->attach($request->municipios);
                break;
            
        }
        // Eliminando las relaciones con categorias de incidentes y creando las nuevas
        $institucion->categorias_incidente()->detach();
        // Atamos las relaciones de las categorias
        $institucion->categorias_incidente()->attach($request->categorias);
        // Redireccionamos al index
        return redirect()->route('admin.institucion.index')->with('mensaje','Se actualizo  la institución '.$institucion->nombre);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institucion $institucion)
    {
        // Eliminamos la institucion 
        $institucion->delete();
        // Redirigimos al index
        return redirect()->route('admin.institucion.index')->with("mensaje",'Se elimino la institución '.$institucion->nombre);
    }


    /**
     * Sube una imagen al storage
     *
     * @param File $imagen
     * @return String
     */
    public function uploadImage($imagen)
    {
        $extension = $imagen->getClientOriginalExtension();
        $file_name = Str::random(40);
        Storage::disk('public')->put('instituciones/'.$file_name.".".$extension, File::get($imagen));
        return 'instituciones/'.$file_name.".".$extension;
    }
}
