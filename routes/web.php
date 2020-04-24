<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->namespace('Incidente')->prefix('incidente')->name('incidente.')->group(function(){
	// Route::get('create','IncidenteController@form_incidente')->name('create');
	Route::get('','RegistroIncidenteController@index')->name('index');
	Route::get('create','RegistroIncidenteController@create')->name('create');
	Route::post('store','RegistroIncidenteController@store')->name('store');
	Route::get('/{incidente}','RegistroIncidenteController@show')->name('show');
	Route::get('/{incidente}/edit','RegistroIncidenteController@edit')->name('edit');
	Route::put('/{incidente}/update','RegistroIncidenteController@update')->name('update');

});

Route::middleware('auth')->namespace('Pdf')->prefix('pdf')->name('pdf.')->group(function(){
	Route::get('incidente/{incidente}','IncidentePdfController@incidenteReport')->name('incidente');
});