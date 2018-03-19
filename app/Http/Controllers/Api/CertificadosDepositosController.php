<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\CertificadoDeposito;
use App\Http\Resources\CertificadosDepositos;
use App\Http\Requests\CertificadosDepositosRequest;

class CertificadosDepositosController extends Controller
{


    public function index(CertificadosDepositosRequest $request)
    {
       	
       	$query = CertificadoDeposito::with(
            'depositante',
            'depositario',
            'laboratorio',
            'origen',
            'entrega',
            'producto',
            'cartasPorte',
            'itemsDetalleServicios',
            'itemsDetalleServicios.tipoItem'
        );

       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'fechaCerificadoDesde':
                    $query->whereDate('fecha_certificado', '>=', $value);
                    break;
                case 'fechaCertificadoHasta':
                    $query->whereDate('fecha_certificado', '<=', $value);
                    break;
                case 'numeroCertificado':
                    $query->where('numero_certificado', $value);
                    break;
                case 'numeroCaiCoe':
                    $query->where('numero_caicoe', $value);
                    break;

                case 'numeroCTG':
                    $query->numeroCTG($value);
                    break;
                case 'cartaPorte':
                    $query->cartaPorte($value);
                    break;

                case 'tipoLiquidacion':
                    $query->where('tipo_liquidacion', $value);
                    break;

                case 'depositante_cuit':
                    $query->depositante($value);
                    break;   
                case 'depositario_cuit':
                    $query->depositario($value);
                    break;   
                case 'producto_codigo':
                    $query->producto($value);
                    break;                                           
                                            
            }        
        }

        return new CertificadosDepositos( $query->paginate($this->pageSize));

    }



}
