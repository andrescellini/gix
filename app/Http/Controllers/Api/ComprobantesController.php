<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Comprobante;
use App\Http\Resources\Comprobantes;
use App\Http\Requests\ComprobantesRequest;

class ComprobantesController extends Controller
{


    public function index(ComprobantesRequest $request)
    {
       	
       	$query = Comprobante::with(
            'emisor',
            'destinatario',
            'detalles',
            'detalles.tipoItem',
            'certificadosDepositoComprobante',
            'parciales',
            'retenciones',
            'percepciones'
        );

       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'fechaComprobanteDesde':
                    $query->whereDate('fecha_comprobante', '>=', $value);
                    break;
                case 'fechaComprobanteHasta':
                    $query->whereDate('fecha_comprobante', '<=', $value);
                    break;
                case 'codigoComprobante':
                    $query->where('id_comprobante', $value);
                    break;
                case 'sucursalComprobante':
                    $query->where('sucursal_comprobante', $value);
                    break;
                case 'numeroComprobante':
                    $query->where('numero_comprobante', $value);
                    break;
                case 'emisorComprobante_cuit':
                    $query->emisor($value);
                    break;   
                case 'destinatarioComprobante_cuit':
                    $query->destinatario($value);
                    break;                                        
                case 'codigoTipoComprobante':
                    $query->where('id_tipo_comprobante', $value);
                    break;            
                case 'letraComprobante':
                    $query->where('letra_comprobante', $value);
                    break;         
                case 'numeroCaiCoe':
                    $query->where('id_tipo_comprobante', $value);
                    break;         
                case 'numeroContratoComprador':
                    $query->where('numero_contrato_comprador', $value);
                    break;         
                case 'numeroContratoVendedor':
                    $query->where('numero_contrato_vendedor', $value);
                    break;         
                case 'numeroContratoCorredor':
                    $query->where('numero_contrato_corredor', $value);
                    break;                                                                                                                     
            }        
        }

        return new Comprobantes( $query->paginate($this->pageSize));

    }



}
