<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'IndexController@index');
Route::post('confirmation', 'IndexController@confirmation');
Route::post('printAction', 'IndexController@printAction');

//Route::get('tickets','TicketController@index');
//Route::get('tickets/create','TicketController@create');
//Route::get('tickets/{id}','TicketController@show');

Route::resource('tickets', 'TicketController');

//Route::get('projects','ProjectController@index');
//Route::get('projects/create','ProjectController@create');
//Route::get('projects/{id}','ProjectController@show');
//Route::post('projects','ProjectController@store');
//Route::get('projects/{id}/edit','ProjectController@edit');

Route::resource('projects', 'ProjectController');

//Route::get('/', function () {
//    return view('welcome');
//});
