<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Covid extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Transformar el modelo en un objeto geojson
        return [
            "type" => "Feature",
            "properties" => [
                "title" => "test_covid",
                "description" => [
                    "folio" => $this->id,
                    "usuario_id" => $this->id_usuario,
                    "lat_especifica" => $this->lat,
                    "long_especifica" => $this->lng,
                    "ubicacion_especifica" => json_encode(['lat' => $this->lat,'lng' => $this->lng]),
                    "edad" => $this->edad,
                    "genero" => $this->genero,
                    "cp" => $this->cp,
                    "fecha" => $this->fecha,
                    "hora" => $this->hora,
                    "convivir_enfermo" => ($this->convivir_enfermo == 1 ? "Si" : "No"),
                    "fiebre" => ($this->fiebre == 1 ? "Si" : "No"),
                    "dolor_cabeza" => ($this->dolor_cabeza == 1 ? "Si" : "No"),
                    "tos" => ($this->tos == 1 ? "Si" : "No"),
                    "dolor_pecho" => ($this->dolor_pecho == 1 ? "Si" : "No"),
                    "dolor_garganta" => ($this->dolor_garganta == 1 ? "Si" : "No" ),
                    "dificultad_respirar" => ($this->dificultad_respirar == 1 ? "Si" : "No"),
                    "escurrimiento_nasal" => ($this->escurrimiento_nasal == 1 ? "Si" : "No"),
                    "dolor_cuerpo" => ($this->dolor_cuerpo == 1 ? "Si" : "No"),
                    "conjuntivitis" => ($this->conjuntivitis == 1 ? "Si" : "No"),
                    "dias_sintomas" => ($this->dias_sintomas == 1 ? "Si" : "No"),
                    "condiciones_medicas" => ($this->condiciones_medicas ? $this->condiciones_medicas : "Sin información"),
                    "embarazada" => ($this->embarazada == 1 ? "Si" : ($this->embarazada == -1 ? "N/A" : "No") ),
                    "meses_embarazo" => ($this->meses_embarazo == -1 ? "N/A" : $this->meses_embarazo),
                    "dolor_respirar" => ($this->dolor_respirar == 1 ? "Si" : ($this->dolor_respirar == -1 ? "N/A" : "No") ),
                    "falta_aire" => ($this->falta_aire == 1 ? "Si" : ($this->falta_aire == -1 ? "N/A" : "No") ),
                    "coloracion_azul" => ($this->coloracion_azul == 1 ? "Si" : ( $this->coloracion_azul == -1 ? "N/A" : "No") ),
                    "score" => $this->score
                ]
            ]
        ];
    }
}
