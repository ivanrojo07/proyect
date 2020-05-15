<?php

namespace App\Observers;

use App\Events\NewIncidente;
use App\Incidente\RegistroIncidente;

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
        event(new NewIncidente($registroIncidente));
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
