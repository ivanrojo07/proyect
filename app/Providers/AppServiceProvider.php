<?php

namespace App\Providers;

use App\Dependencia\ReporteDependencia;
use App\Incidente\RegistroIncidente;
use App\Observers\RegistroIncidenteObserver;
use App\Observers\ReporteDependenciaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        RegistroIncidente::observe(RegistroIncidenteObserver::class);
        ReporteDependencia::observe(ReporteDependenciaObserver::class);
    }
}
