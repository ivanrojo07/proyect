<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistroIncidente extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => "Feature",
            "properties" => [
                "title" => "incidentes",
                "description" => [
                    'serie' => $this->serie_id,
                    'descripcion' => $this->descripcion,
                    'catalogo_incidente' => $this->catalogo_incidente->load(["prioridad","subcategoria","subcategoria.categoria"]),
                    'locacion' => $this->locacion,
                    'lat_especifica' => $this->lat_especifica,
                    'long_especifica' => $this->long_especifica,
                    'ubicacion_especifica' => json_encode(['lat'=>$this->lat_especifica,'long'=>$this->long_especifica]),
                    'estado' => $this->estado,
                    'municipio' => $this->municipio,
                    'localidades_afectadas' => $this->localidades,
                    'lugares_afectados' => $this->lugares_afectados,
                    'fecha_registro' => $this->fecha_registro,
                    'hora_registro' => $this->hora_registro,
                    'fecha_ocurrencia' => $this->fecha_ocurrencia,
                    'hora_ocurrencia' => $this->hora_ocurrencia,
                    'afectacion_vial' => $this->afectacion_vial,
                    'afectacion_infraestructural' => $this->afectacion_infraestructural,
                    'danio_colateral' => $this->danio_colateral,
                    'estatus' => $this->estatus,
                    'impacto' => $this->seguimiento,
                    'medidas_control' => $this->medidas_control,
                    'personas_afectadas' => $this->personas_afectadas,
                    'personas_lesionadas' => $this->personas_lesionadas,
                    'personas_fallecidas' => $this->personas_fallecidas,
                    'personas_desaparecidas' => $this->personas_desaparecidas,
                    'personas_evacuadas' => $this->personas_evacuadas,
                    'respuesta_institucional_json' => $this->respuesta_institucional,
                    'respuesta_institucional' =>[
                        'dependencia' => $this->dependencia,
                        'nombre_empleado' => $this->nombre_empleado,
                        'cargo_empleado' => $this->cargo_empleado
                    ],
                    'usuario' => $this->user,
                    'dependencia_llamada' => $this->dependencia_llamada,
                    'dependencia_reportes' => $this->dependencia_reportes
                ],
                "showpointincidentes"=>true,
                "image" =>"incidentes.png"
            ],
            "geometry" => [
                "type"=>"Point",
                "coordinates"=>[
                    $this->lat_especifica,
                    $this->long_especifica
                ]
            ]
        ];
    }
}
