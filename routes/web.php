<?php

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

// Rotas de clientes
Route::resource('clientes', 'ClienteController')->middleware('auth');
Route::post('cliente', 'ClienteController@find')->name('clientes.find')->middleware('auth');

// Rotas de pacientes
Route::resource('pacientes', 'PacienteController')->middleware('auth');
Route::post('paciente', 'PacienteController@find')->name('pacientes.find')->middleware('auth');