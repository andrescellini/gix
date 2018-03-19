<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;


class MuestrasRequest extends GixRequest
{
    
	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/
    protected $noUnivocos = [
    ];

    protected $univocos = [
        'numeroMuestra' => 'numeric',
        'cartaPorte' => 'numeric',
    ];

    protected $fechas = [
	    'fechaDescargaDesde' => 'date_format:Ymd',
        'fechaDescargaHasta' => 'date_format:Ymd',
    ];


   
}

