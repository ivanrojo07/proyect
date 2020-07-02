<?php

namespace App\Events;

use App\Incidente\RegistroIncidente;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewIncidente implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $registro;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RegistroIncidente $registro)
    {
        //
        $this->registro = $registro->load(['catalogo_incidente','estado','municipio','impacto','seguimiento']);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];
        // introducir channel para institucion federal
        array_push($channels, new PrivateChannel('incidentes_federal'));
        // introducir channels de las instituciones que tienen el mismo estado
        foreach ($this->registro->estado->institucions as $institucion) {
            // se crea los incidentes de la institucion
            array_push($channels, new PrivateChannel('incidentes_estatal.'.$institucion->id));
            
        }
        // Introducir channels de las instituciones que tienen  el mismo municipio
        if ($this->registro->municipio) {
            foreach ($this->registro->municipio->institucions as $institucion) {
                array_push($channels, new PrivateChannel('incidentes_municipal.'.$institucion->id));
            }
        }
        return $channels;
    }
}
