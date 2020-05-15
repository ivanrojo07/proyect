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
    public function __construct($registro)
    {
        //
        $this->registro = $registro;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('incidentes');
    }
}
