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
    public function index()
    {
        //
        $instituciones = Institucion::orderBy('nombre','asc')->paginate(7);
        return view('admin.institucion.index',['instituciones'=>$instituciones]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $estados = Estado::orderBy('nombre','asc')->get();
        $categorias_incidente = CategoriaIncidente::orderBy('nombre','asc')->get();
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
        //
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
        // dd($request->all());
        $request->validate($rules);
        // verificamos si header_1 es archivo valido
        if ($request->file('header_1')) {
            $path_imagen_header = $this->uploadImage($request->file("header_1"));
        } else {
            return redirect()->route('admin.institucion.create');
        }

        // verificamos si header_2 es archivo valido
        if ($request->file('header_2')) {
            $path_imagen_header2 = $this->uploadImage($request->file('header_2'));
        } else {
            $path_imagen_header2 = null;
        }
        // verificamos si favicon es archivo valido
        if ($request->file('favicon')) {
            $path_imagen_favicon = $this->uploadImage($request->file('favicon'));
        } else {
            $path_imagen_favicon = null;
        }
        // verificamos si footer es archivo valido
        if ($request->file('footer')) {
            $path_imagen_footer = $this->uploadImage($request->file('footer'));
        } else {
            $path_imagen_footer = null;
        }

        $institucion = new Institucion([
            'nombre' => $request->nombre,
            'tipo_institucion' => $request->tipo_institucion,
            'path_imagen_header' => $path_imagen_header,
            'path_imagen_header2' => $path_imagen_header2,
            'path_imagen_favicon' => $path_imagen_favicon,
            'path_imagen_footer' => $path_imagen_footer
        ]);
        $institucion->save();
        $institucion->categorias_incidente()->attach($request->categorias);
        switch ($request->tipo_institucion) {
            case "Federal":
                $estados = Estado::get();
                $institucion->estados()->saveMany($estados);
                break;

            case "Estatal":
                $institucion->estados()->attach($request->estados);
                break;

            case "Municipal":
                $institucion->municipios()->attach($request->municipios);
                break;
            
        }
        
        return redirect()->route('admin.institucion.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show(Institucion $institucion)
    {
        //
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
        //
        $estados = Estado::orderBy('nombre','asc')->get();
        $categorias_incidente = CategoriaIncidente::orderBy('nombre','asc')->get();
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
        //
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
        $request->validate($rules);
        // dd($request->all());
        $request->validate($rules);
        // verificamos si header_1 es archivo valido
        if ($request->file('header_1')) {
            $path_imagen_header = $this->uploadImage($request->file("header_1"));
            if ($path_imagen_header) {
                Storage::disk('public')->delete($institucion->path_imagen_header);
                $institucion->path_imagen_header = $path_imagen_header;
            }
        } 

        // verificamos si header_2 es archivo valido
        if ($request->file('header_2')) {
            $path_imagen_header2 = $this->uploadImage($request->file('header_2'));
            if ($path_imagen_header2) {
                Storage::disk('public')->delete($institucion->path_imagen_header2);
                $institucion->path_imagen_header2 = $path_imagen_header2;
            }
        } 
        // verificamos si favicon es archivo valido
        if ($request->file('favicon')) {
            $path_imagen_favicon = $this->uploadImage($request->file('favicon'));
            if ($path_imagen_favicon) {
                Storage::delete('public')->delete($institucion->path_imagen_favicon);
                $institucion->path_imagen_favicon = $path_imagen_favicon;
            }
        } 
        // verificamos si footer es archivo valido
        if ($request->file('footer')) {
            $path_imagen_footer = $this->uploadImage($request->file('footer'));
            if ($path_imagen_footer) {
                Storage::disk('public')->delete($institucion->path_imagen_favicon);
                $institucion->path_imagen_footer = $path_imagen_footer;
            }
        }
        $institucion->nombre = $request->nombre;
        $institucion->tipo_institucion = $request->tipo_institucion;
        $institucion->save();
        // eliminando las relaciones con estados
        $institucion->estados()->detach();
        // Eliminando  las relaciones con municipios
        $institucion->municipios()->detach();
        // Actualizando nuevas relaciones
        $institucion->categorias_incidente()->attach($request->categorias);
        switch ($request->tipo_institucion) {
            case "Federal":
                $estados = Estado::get();
                $institucion->estados()->saveMany($estados);
                break;

            case "Estatal":
                $institucion->estados()->attach($request->estados);
                break;

            case "Municipal":
                $institucion->municipios()->attach($request->municipios);
                break;
            
        }
        // Eliminando las relaciones con categorias de incidentes y creando las nuevas
        $institucion->categorias_incidente()->detach();
        $institucion->categorias_incidente()->attach($request->categorias);
        return redirect()->route('admin.institucion.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institucion $institucion)
    {
        //
        $institucion->delete();
        return redirect()->route('admin.institucion.index');
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
