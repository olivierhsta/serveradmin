<?php

use Illuminate\Http\Request;

Route::get('/servers', 'ServerController@index');
Route::post('/server', 'ServerController@store');
Route::patch('/server/{server}', 'ServerController@update');
Route::delete('/server/{server}', 'ServerController@destroy');
