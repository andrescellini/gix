<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;

class CertificadosDepositosRequest extends GixRequest
{

	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/

    protected $noUnivocos = [
	    'tipoLiquidacion' => 'string',
	    'depositante_cuit' => 'numeric',
	    'depositario_cuit' => 'numeric',
	    'producto_codigo' => 'integer',
    ];

    protected $univocos = [
	    'numeroCertificado' => 'numeric',
	    'numeroCaiCoe' => 'numeric',
	    'numeroCTG' => 'numeric',
		'cartaPorte' => 'string',
    ];

    protected $fechas = [
	    'fechaCertificadoDesde' => 'date_format:Ymd',
        'fechaCertificadoHasta' => 'date_format:Ymd',
    ];


}
