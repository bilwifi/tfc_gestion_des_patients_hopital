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

Route::get('/', 'PublicController@index')->name('welcome');
Route::post('/', 'PublicController@addPatient');
Route::get('/affiche', 'PublicController@affiche')->name('affiche');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/traiter/{patient}', 'HomeController@traiterPatient')->name('traiter_patient');
Route::get('/appeler/{patient}', 'HomeController@appelerPatient')->name('appeler_patient');
Route::get('/passer/{patient}', 'HomeController@passerPatient')->name('passer_patient');

// partials Ajax

