<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;


class ContratosRequest extends GixRequest
{
    
	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/
    protected $noUnivocos = [
	    'comprador_cuit' => 'numeric',
	    'vendedor_cuit' => 'numeric',
	    'corredor_cuit' => 'numeric',
	    'producto_codigo' => 'integer',
    ];

    protected $univocos = [
	    'numeroContratoComprador' => 'string',
	    'numeroContratoVendedor' => 'string',
	    'numeroContratoCorredor' => 'string',
    ];

    /* que pasa si defino mas de 1 par de fechas? */
    protected $fechas = [
	    'fechaContratoHasta' => 'date_format:Ymd',
        'fechaContratoDesde' => 'date_format:Ymd',
    ];


   
}

