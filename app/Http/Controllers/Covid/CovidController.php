<?php

namespace App\Http\Controllers\Covid;

use App\Covid\Covid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CovidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Ruta GET ../covid
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Si existe el request fecha
        if ($request->fecha) {
            // Validamos el request a que sea una fecha valida
            $validate = Validator::make($request->all(),['fecha'=>'required|date|date_format:Y-m-d']);
            // Si la validacion falla 
            if ($validate->fails()) {
                // redirigimos al index
                return redirect()->route('covid.index');
            } else {
                // creamos la fecha
                $date = Date($request->fecha);
            }
        } else {
            // Si no existe la fecha la creamos con la fecha actual
            $date = Date('Y-m-d');
        }
        $registros_covid = Covid::where(DB::raw('DATE(fecha)'),$date)->orderBy('hora','asc')->get();
        return view('covid.index',[
            'registros' => $registros_covid,
            'fecha' => $date
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Ruta GET ../covid/create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retornamos la vista para el formulario
        return view('covid.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Ruta POST ../covid/store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creamos las reglas de validacion
        $rules = [
            "edad" => "required|numeric",
            "genero" => "required|string|in:Mujer,Hombre",
            "codigo_postal" => "required|numeric",
            "convivir_enfermo" => "required|numeric|in:1,0",
            "fiebre" => "required|numeric|in:1,0",
            "dolor_cabeza" => "required|numeric|in:1,0",
            "tos" => "required|numeric|in:1,0",
            "dolor_pecho" => "required|numeric|in:1,0",
            "dolor_garganta" => "required|numeric|in:1,0",
            "dificultad_respirar" => "required|numeric|in:1,0",
            "escurrimiento_nasal" => "required|numeric|in:1,0",
            "dolor_cuerpo" => "required|numeric|in:1,0",
            "conjuntivitis" => "required|numeric|in:1,0",
            "condiciones_medicas" => "required|numeric|in:1,0",
            "embarazada" => "nullable|required_if:genero,Mujer|numeric|in:1,0",
            "meses_embarazo" => "nullable|required_if:genero,Mujer|numeric|in:1,0",
            "dias_sintomas" => "nullable|numeric",
            "dolor_respirar" => "nullable|numeric|in:1,0",
            "falta_aire" => "nullable|numeric|in:1,0",
            "coloracion_azul" => "nullable|numeric|in:1,0"
        ];
        // validamos el request con las reglas
        $request->validate($rules);
        // Creamos un nuevo modelo covid
        $registro = new Covid([
            'convivir_enfermo' => $request->convivir_enfermo,
            'fiebre' => $request->fiebre,
            'dolor_cabeza' => $request->dolor_cabeza,
            'tos' => $request->tos,
            'dolor_pecho' => $request->dolor_pecho,
            'dolor_garganta' => $request->dolor_garganta,
            'dificultad_respirar' => $request->dificultad_respirar,
            'escurrimiento_nasal' => $request->escurrimiento_nasal,
            'dolor_cuerpo' => $request->dolor_cuerpo,
            'conjuntivitis' => $request->conjuntivitis,
            'condiciones_medicas' => $request->condiciones_medicas,
            'embarazada' => ($request->genero == "Hombre" ? -1 : $request->embarazada),
            'meses_embarazo' => ($request->genero == "Hombre" ? -1 : $request->meses_embarazo),
            'dias_sintomas' => $request->dias_sintomas,
            'dolor_respirar' => ($request->dolor_respirar ? $request->dolor_respirar : -1),
            'falta_aire' => ($request->falta_aire ? $request->falta_aire : -1),
            'coloracion_azul' => ($request->coloracion_azul ? $request->coloracion_azul : -1),
            'lat' => 0,
            'lng' => 0,
            'fecha' => Date('Y-m-d'),
            'hora' => Date('H:i:s'),
            'proyecto' => "sedena",
            'origen' => "Web",
            'id_usuario' => $request->user()->id,
            'edad'=>$request->edad,
            'genero' => $request->genero,
            'cp' => $request->codigo_postal,
            // 'perfil' => json_encode([
            //                 'edad'=>$request->edad,
            //                 'genero' => $request->genero,
            //                 'codigo_postal' => $request->codigo_postal
            //             ]),
            'score' => $request->score
        ]);
        // le asignamos el usuario que registro
        $registro->user_id = Auth::user()->id;
        // Salvamos el registro
        $registro->save();
        // Redireccionamos al index
        return redirect()->route('covid.index');

    }

    /**
     * Display the specified resource.
     *
     * Ruta GET ../covid/show/{covid}
     *
     * @param  \App\Covid\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function show(Covid $covid)
    {

        // retornamos la vista con el registro
        return view('covid.show',['covid'=>$covid]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @param  \App\Covid\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function edit(Covid $covid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Covid\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Covid $covid)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Covid\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Covid $covid)
    // {
    //     //
    // }
}
