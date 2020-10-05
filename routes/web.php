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

// Récupère la liste des tasks
Route::get('/tasksList', 'TaskController@index');
// Enregistre les tasks du formulaire en BDD
Route::post('/tasksList', 'TaskController@store');

// Edit une task
Route::get('/tasks/edit/{id}', 'TaskController@edit');

// Edit une task
Route::patch('/tasks/edit/{id}', 'TaskController@update');