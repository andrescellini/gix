<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\ApiLoginController@login')->name('login');
Route::post('/refresh', 'Auth\ApiLoginController@refresh')->name('refresh');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::middleware('auth:api')->group(function () {
    
    Route::post('/logout', 'Auth\ApiLoginController@logout')->name('logout');
    Route::get('/user', 'Auth\ApiLoginController@user')->name('user');

    Route::get('/contratos', 'Api\ContratosController@index')->name('contratos');
    Route::get('/descargas', 'Api\DescargasController@index')->name('descargas');
    Route::get('/fijaciones', 'Api\FijacionesController@index')->name('fijaciones');
    Route::get('/aplicaciones', 'Api\AplicacionesController@index')->name('aplicaciones');
    Route::get('/comprobantes', 'Api\ComprobantesController@index')->name('comprobantes');
    Route::get('/certificadosDepositos', 'Api\CertificadosDepositosController@index')->name('certificadosDepositos');
    Route::get('/muestras', 'Api\MuestrasController@index')->name('muestras');
    
});
