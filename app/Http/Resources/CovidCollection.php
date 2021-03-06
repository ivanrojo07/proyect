<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CovidCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Convierte un array de objetos en un array geojson
        return [
            "type" => "FeatureCollection",
            "features" => $this->collection
        ];
    }
}
