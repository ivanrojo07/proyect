<?php

namespace App\Observers;

use App\Events\NewIncidente;
use App\Incidente\RegistroIncidente;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Support\Facades\Log;

class RegistroIncidenteObserver
{
    /**
     * Handle the registro incidente "created" event.
     *
     * @param  \App\Incidente\RegistroIncidente  $registroIncidente
     * @return void
     */
    public function created(RegistroIncidente $registroIncidente)
    {
        //
        try {
            event(new NewIncidente($registroIncidente));
            
        } catch (BroadcastException $e) {
            Log::warning("Pusher Broadcast Exception, $e");
        }
    }

    /**
     * Handle the registro incidente "updated" event.
     *
     * @param  \App\Incidente\RegistroIncidente  $registroIncidente
     * @return void
     */
    public function updated(RegistroIncidente $registroIncidente)
    {
        //
    }

    /**
     * Handle the registro incidente "deleted" event.
     *
     * @param  \App\Incidente\RegistroIncidente  $registroIncidente
     * @return void
     */
    public function deleted(RegistroIncidente $registroIncidente)
    {
        //
    }

    /**
     * Handle the registro incidente "restored" event.
     *
     * @param  \App\Incidente\RegistroIncidente  $registroIncidente
     * @return void
     */
    public function restored(RegistroIncidente $registroIncidente)
    {
        //
    }

    /**
     * Handle the registro incidente "force deleted" event.
     *
     * @param  \App\Incidente\RegistroIncidente  $registroIncidente
     * @return void
     */
    public function forceDeleted(RegistroIncidente $registroIncidente)
    {
        //
    }
}
