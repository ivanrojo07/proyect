<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Institucion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->tipo_institucion == "Federal" || $this->tipo_institucion == "Estatal") {
            $regiones = $this->estados;
        }
        else{
            $regiones = $this->municipios;
        }
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'tipo_institucion' => $this->tipo_institucion,
            'path_imagen_header' => $this->path_imagen_header,
            'path_imagen_header2' => $this->path_imagen_header2,
            'path_imagen_favicon' => $this->path_imagen_favicon,
            'path_imagen_footer' => $this->path_imagen_footer,
            'regiones' => $regiones,
            'categorias_incidentes'=>$this->categorias_incidente->load(['subcategorias','subcategorias.catalogos'])
        ];
    }
}
