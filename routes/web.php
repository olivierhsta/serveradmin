<?php


Route::get('/', function () {
    return view('servers');
})->middleware('auth.basic');
