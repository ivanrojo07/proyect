<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('incidentes_federal',function($user){
	return $user->institucion->tipo_institucion === "Federal";
});

Broadcast::channel('incidentes_estatal.{institucion_id}',function($user,$institucion_id){
	return (int) $user->institucion_id === (int) $institucion_id;
});

Broadcast::channel('incidentes_municipal.{institucion_id}',function($user,$institucion_id){
	return (int) $user->institucion_id === (int) $institucion_id;
});