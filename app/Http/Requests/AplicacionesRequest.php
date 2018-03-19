<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;


class AplicacionesRequest extends GixRequest
{
    
	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/
    protected $noUnivocos = [
	    'numeroContratoComprador' => 'numeric',
	    'numeroContratoVendedor' => 'numeric',
	    'numeroContratoCorredor' => 'numeric',
        'idInternoFijacionComprador' => 'numeric',
	    'cartaPorte' => 'numeric',
    ];

    protected $univocos = [
    ];

    /* que pasa si defino mas de 1 par de fechas? */
    protected $fechas = [
	    'fechaAplicacionDesde' => 'date_format:Ymd',
        'fechaAplicacionHasta' => 'date_format:Ymd',
    ];


   
}

