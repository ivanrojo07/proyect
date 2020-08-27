<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReporteDependencia extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Retornamos un objeto geojson del modelo reporte dependencia
        
        return [
            "type" => "Feature",
            "properties" => [
                "title" => "reporte_dependencias",
                "descripcion" => [
                    'id' => $this->id,
                    'zp' => $this->zp,
                    'sector' => $this->sector,
                    'cuadrante' => $this->cuadrante,
                    'h_lectura' => $this->h_lectura,
                    'motivo' => $this->motivo,
                    'observacion' => $this->observacion,
                    'f_transmision' => $this->f_transmision,
                    'atencion' => $this->atencion,
                    'razonamiento' => $this->razonamiento,
                    'f_razonamiento' => $this->f_razonamiento,
                    'obs_noatencion' => $this->obs_noatencion,
                    'nombre_encargado' => $this->nombre_encargado,
                    'razon_noatencion' => $this->razon_noatencion,
                    'dependencia' => $this->dependencia,
                    'folio' => $this->folio,
                    'incidente' => $this->registro_incidente
                ]
            ]
        ];
    }
}
