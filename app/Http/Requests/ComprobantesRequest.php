<?php

namespace App\Http\Requests;

use App\Http\Requests\GixRequest;

class ComprobantesRequest extends GixRequest
{

	/* los univocos operan sin problemas. cuando detecto no univoco debo tener si o si todos los campos claves,*/

    protected $noUnivocos = [
	    'emisorComprobante_cuit' => 'numeric',
	    'destinatarioComprobante_cuit' => 'numeric',
	    'codigoTipoComprobante' => 'integer',
	    'letraComprobante' => 'string',
	    'numeroCaiCoe' => 'numeric'
    ];

    protected $univocos = [
	    'codigoComprobante' => 'numeric',
	    'sucursalComprobante' => 'integer',
	    'numeroComprobante' => 'numeric',
		'numeroContratoComprador' => 'string',
		'numeroContratoVendedor' => 'string',
		'numeroContratoCorredor' => 'string',
    ];

    /* que pasa si defino mas de 1 par de fechas? */
    protected $fechas = [
	    'fechaComprobanteDesde' => 'date_format:Ymd',
        'fechaComprobanteHasta' => 'date_format:Ymd',
    ];


}
