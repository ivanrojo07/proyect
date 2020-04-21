<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('oauth/login','Api\Auth\LoginController@login');

Route::middleware('auth:api')
	->namespace('Api\Incidente')
	->prefix('incidentes')
	->name('incindentes.')
	->group(function(){

		Route::get('/','RegistroIncidenteController@index')->name('index');
		Route::get('/today','RegistroIncidenteController@incidentesHoy')->name('today');
		Route::get('/show/{incidente}','RegistroIncidenteController@show')->name('show');
		Route::get('/{fecha}','RegistroIncidenteController@incidentesDate')->name('date');
		Route::get('/{fecha1}/{fecha2}','RegistroIncidenteController@incidentesBetween')->name('between');
		Route::post('/store','RegistroIncidenteController@store')->name('store');
		

});

// web
Route::namespace('Api\Web')
	->prefix('web')
	->name('web.')
	->group(function(){
		Route::get('estados','EstadosController@getEstados');
		Route::get('estados/{estado_id}/municipios','EstadosController@getMunicipios');
		Route::get('municipios/{municipio}/localidades','EstadosController@getLocalidades');
		Route::get('incidentes/{categoria}','IncidentesController@getIncidentes');
		Route::get('show_municipios/{estado_id}','EstadosController@showMunicipios');

});
