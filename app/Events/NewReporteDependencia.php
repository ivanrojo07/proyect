<?php

namespace App\Events;

use App\Dependencia\ReporteDependencia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewReporteDependencia implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reporte;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReporteDependencia $reporteDependencia)
    {
        //
        $this->reporte = $reporteDependencia->load(['registro_incidente','registro_incidente.impacto']);
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
        foreach ($this->reporte->registro_incidente->estado->institucions as $institucion) {
            // se crea los incidentes de la institucion
            array_push($channels, new PrivateChannel('incidentes_estatal.'.$institucion->id));
            
        }
        // Introducir channels de las instituciones que tienen  el mismo municipio
        foreach ($this->reporte->registro_incidente->municipio->institucions as $institucion) {
            array_push($channels, new PrivateChannel('incidentes_municipal.'.$institucion->id));
        }
        return $channels;
    }
}
