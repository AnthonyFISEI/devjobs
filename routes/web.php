<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes(['verify' => true]);



//Rutas protegidas
Route::group(['middleware' => ['auth','verified']], function(){
    Route::get('/vacantes','VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create','VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes','VacanteController@store')->name('vacantes.store');
    Route::delete('/vacantes/{vacante}','VacanteController@destroy')->name('vacantes.destroy');
    Route::get('/vacantes/{vacante}/edit','VacanteController@edit')->name('vacantes.edit');
    Route::put('/vacantes/{vacante}','VacanteController@update')->name('vacantes.update');
    //Subir Imagenes

    Route::post('/vacantes/imagen','VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen','VacanteController@borrarimagen')->name('vacantes.borrar');

    //Notificaciones
    //Esta es de tipo invoke
    Route::get('/notificaciones','NotificacionesController')->name('notificaciones');

    //Cambiar estado de la vacante

    Route::post('/vacantes/{vacante}','VacanteController@estado')->name('vacantes.estado');


});



//Pagina de Inciio


//Categorias

Route::get('/categorias/{categoria}','CategoriaController@show')->name('categorias.show');

Route::get('/','InicioController')->name('inicio');
// Enviar datos para una vacante
Route::get('/candidatos/{id}','CandidatoController@index')->name('candidatos.index');
Route::post('/candidatos/store','CandidatoController@store')->name('candidatos.store');

// Rutas de Vacantes que no necesitan autenticacion

Route::get('/busqueda/buscar','VacanteController@resultados')->name('vacantes.resultados');
Route::post('/busqueda/buscar','VacanteController@buscar')->name('vacantes.buscar');

Route::get('/vacantes/{vacante}','VacanteController@show')->name('vacantes.show');
