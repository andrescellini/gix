<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;


class FijacionesRequest extends GixRequest
{
    
	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/
    protected $noUnivocos = [
	    'numeroContratoComprador' => 'string',
	    'numeroContratoVendedor' => 'string',
	    'numeroContratoCorredor' => 'string',
	    'idInternoFijacionComprador' => 'integer',
    ];

    protected $univocos = [
    ];

    /* que pasa si defino mas de 1 par de fechas? */
    protected $fechas = [
	    'fechaFijacionDesde' => 'date_format:Ymd',
        'fechaFijacionHasta' => 'date_format:Ymd',
    ];


   
}

