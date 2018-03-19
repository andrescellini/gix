<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;

class DescargasRequest extends GixRequest
{

	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/

    protected $noUnivocos = [
	    'comprador_cuit' => 'numeric',
	    'vendedor_cuit' => 'numeric',
	    'corredorComprador_cuit' => 'numeric',
	    'corredorVendedor_cuit' => 'numeric',
	    'producto_codigo' => 'integer',
	    'fechaDescarga' => 'date',
	    'statusCamionEnPuerto' => 'string',
    ];

    protected $univocos = [
	    'cartaPorte' => 'numeric',
	    'numeroCTG' => 'numeric',
	    'numeroContratoComprador' => 'string',
		'numeroContratoVendedor' => 'string',
		'numeroContratoCorredor' => 'string',
	    'alfanumericoCupo' => 'string',
    ];

    /* que pasa si defino mas de 1 par de fechas? */
    protected $fechas = [
	    'fechaCargaDesde' => 'date_format:Ymd',
        'fechaCargaHasta' => 'date_format:Ymd',
    ];



}
