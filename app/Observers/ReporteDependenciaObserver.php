<?php

namespace App\Observers;

use App\Dependencia\ReporteDependencia;
use App\Events\NewReporteDependencia;
use Illuminate\Broadcasting\BroadcastException;

class ReporteDependenciaObserver
{
    /**
     * Handle the reporte dependencia "created" event.
     *
     * @param  \App\Dependencia\ReporteDependencia  $reporteDependencia
     * @return void
     */
    public function created(ReporteDependencia $reporteDependencia)
    {
        //
        try {
            event(new NewReporteDependencia($reporteDependencia));
        } catch (BroadcastException $e) {
            Log::warning("Pusher Broadcast Exception, $e");
        }
    }

    /**
     * Handle the reporte dependencia "updated" event.
     *
     * @param  \App\Dependencia\ReporteDependencia  $reporteDependencia
     * @return void
     */
    public function updated(ReporteDependencia $reporteDependencia)
    {
        //
        dd('updated');
    }

    /**
     * Handle the reporte dependencia "deleted" event.
     *
     * @param  \App\Dependencia\ReporteDependencia  $reporteDependencia
     * @return void
     */
    public function deleted(ReporteDependencia $reporteDependencia)
    {
        //
        dd('deleted');
    }

    /**
     * Handle the reporte dependencia "restored" event.
     *
     * @param  \App\Dependencia\ReporteDependencia  $reporteDependencia
     * @return void
     */
    public function restored(ReporteDependencia $reporteDependencia)
    {
        //
        dd('restored');
    }

    /**
     * Handle the reporte dependencia "force deleted" event.
     *
     * @param  \App\Dependencia\ReporteDependencia  $reporteDependencia
     * @return void
     */
    public function forceDeleted(ReporteDependencia $reporteDependencia)
    {
        //
        dd("forceDeleted");
    }
}
