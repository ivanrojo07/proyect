<?php

use App\Estado;
use App\Incidente\CategoriaIncidente;
use App\Roles\Institucion;
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

Route::get('blueprint',function(){
	return view('blueprint');
});

Route::get('API/Cuenta360/access_token/addService/{user_id}/{access_token}',function(){
	$estados = Estado::orderBy('nombre','asc')->get();
	$categorias_incidente = CategoriaIncidente::orderBy('nombre','asc')->get();
	$instituciones = Institucion::orderBy('nombre','asc')->get();
	return view('register_form',['estados' => $estados,'categorias_incidente'=> $categorias_incidente,'instituciones'=>$instituciones]);
});
Route::get('/', function () {
	// Si esta autenticado, redirigir al home
	if (Auth::user()) {
		return redirect()->route('home');
	}
	else{
		// si no, mostrar vista principal
    	return view('welcome');		
	}
});

// Auth::routes([
// 	'register'=>false
// ]);
Route::post('logout', "Auth\LoginController@logout")->name("logout");

Route::middleware(["guest"])->group(function(){
	Route::get("/login", "Auth\LoginController@showLoginForm")->name('login');
	Route::post("/login", "Auth\LoginController@handleProviderCallback")->name("login_submit");
	// Route::get("access_token/{user_id}/{token}", 'Auth\LoginController@getAccessToken')->name("getAccessToken");
	Route::get("API/cuenta360/access_token/{user_id}/{access_token}",'Auth\LoginController@verificaCuenta360')->name("a_t_cuenta360");
	Route::get('/registrar','Auth\RegisterController@form')->name('registrar_form');
	Route::post('/registrar','Auth\RegisterController@registrar')->name('registrar');
});

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
	Route::get('incidente','IncidentePdfController@incidenteIndexReport')->name('incidente.index');
	Route::get('incidente/{incidente}','IncidentePdfController@incidenteShowReport')->name('incidente.show');
});

Route::middleware('auth')->namespace('Covid')->prefix('covid')->name('covid.')->group(function(){
	Route::get('','CovidController@index')->name('index');
	Route::get('/create','CovidController@create')->name('create');
	Route::post('/store','CovidController@store')->name('store');
	Route::get('/show/{covid}','CovidController@show')->name('show');
});


Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){	
	Route::resource('institucion','InstitucionController');
	Route::resource('usuarios','UsuariosController');
});