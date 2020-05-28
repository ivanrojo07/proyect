<?php

namespace App\Http\Controllers\Covid;

use App\Covid\Covid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CovidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->fecha) {
            $validate = Validator::make($request->all(),['fecha'=>'required|date|date_format:Y-m-d']);
            if ($validate->fails()) {
                return redirect()->route('covid.index');
            } else {
                $date = Date($request->fecha);
            }
        } else {
            $date = Date('Y-m-d');
        }
        $registros_covid = Covid::where('fecha',$date)->orderBy('hora','asc')->get();
        return view('covid.index',[
            'registros' => $registros_covid,
            'fecha' => $date
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('covid.create');
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
        $request->validate($rules);
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
            'perfil' => json_encode([
                            'edad'=>$request->edad,
                            'genero' => $request->genero,
                            'codigo_postal' => $request->codigo_postal
                        ]),
            'rango' => $request->score
        ]);
        $registro->user_id = Auth::user()->id;
        $registro->save();
        return redirect()->route('covid.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Covid\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function show(Covid $covid)
    {
        //
        $perfil = json_decode($covid->perfil);
        return view('covid.show',['covid'=>$covid,'perfil'=>$perfil]);
    }

    /**
     * Show the form for editing the specified resource.
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
    public function update(Request $request, Covid $covid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Covid\Covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Covid $covid)
    {
        //
    }
}
