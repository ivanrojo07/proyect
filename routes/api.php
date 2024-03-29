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

Route::get('codigo_postal/{codigo_postal}','Api\Estado\CodigoPostalController')->name('codigo_postal')->where(['codigo_postal' => '[0-9]{5}']);

Route::post('/getAccessToken','Auth\LoginController@getAccessToken')->name('getAccessToken');

Route::post('oauth/login','Api\Auth\LoginController@login');

Route::namespace('Api\Institucion')
	->prefix('institucions')
	->name('institucions.')
	->group(function(){
		Route::get('/','InstitucionController@index')->name('index');
		Route::get('/{institucion}', 'InstitucionController@show')->name('show');
});

Route::middleware('auth:api')
	->namespace('Api\Incidente')
	->prefix('incidentes')
	->name('incindentes.')
	->group(function(){


		Route::get('/','RegistroIncidenteController@index')->name('index');
		Route::post('/update','RegistroIncidenteController@updateIncidente')->name('update');
		Route::post('/serie','RegistroIncidenteController@getSerie')->name('serie');
		Route::get('/select/{fechas}','RegistroIncidenteController@select')->name('select')->where(array('fechas'=>'[0-9]{4}-[0-9]{2}-[0-9]{2}_[0-9]{4}-[0-9]{2}-[0-9]{2}+'));
		// Route::get('/today','RegistroIncidenteController@incidentesHoy')->name('today');
		// Route::get('/show/{incidente}','RegistroIncidenteController@showIncidente')->name('show');
		// Route::post('/store','RegistroIncidenteController@storeIncidente')->name('store');
		Route::post('/reporte_dependencia','RegistroIncidenteController@reporteDependencia')->name('reporte_dependencia');
		Route::get('/catalogo_incidente','CatalogoIncidenteController@catalogo')->name('catalogo_incidente');
		Route::get('/tipo_seguimiento','CatalogoIncidenteController@tipoSeguimiento')->name('tipo_seguimiento');
		Route::get('/nivel_impacto','CatalogoIncidenteController@nivelImpacto')->name('nivel_impacto');


		// Route::get('/{fecha}','RegistroIncidenteController@incidentesDate')->name('date');
		// Route::get('/{fecha1}/{fecha2}','RegistroIncidenteController@incidentesBetween')->name('between');
});

Route::middleware('auth:api')
	->namespace('Api\Covid')
	->prefix('test_covid')
	->name('test_covid.')
	->group(function(){

		Route::post('/store','CovidController@store')->name('store');
		Route::get('/select/{fechas}','CovidController@select')->name('select')->where(array('fechas'=>'[0-9]{4}-[0-9]{2}-[0-9]{2}_[0-9]{4}-[0-9]{2}-[0-9]{2}+'));
		Route::get('/last_ten/{id}','CovidController@lastTen')->name('last_ten');

});

Route::middleware('auth:api')
	->namespace('Api\Estado')
	->prefix('estados')
	->name('estados.')
	->group(function(){
		Route::get('/','EstadoController@estados');
		Route::get('/{estado}/municipios','EstadoController@municipios');
		Route::get('/{municipio}/localidades','EstadoController@localidades');
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