<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Descarga;
use App\Http\Resources\Descargas;
use App\Http\Requests\DescargasRequest;

class DescargasController extends Controller
{


  
    public function index(DescargasRequest $request)
    {
       	
       	$query = Descarga::with(
           'titular',
           'intermediario',
           'remitenteComercial',
           'corredorComprador',
           'corredorVendedor',
           'mercadoaTermino',
           'intermediarioFlete',
           'entregador',
           'destinatario',
           'destino',
           'transportista',
           'chofer',
           'vendedor',
           'comprador',
           'vendedorTermino',
           'compradortermino',
           'corredorTermino',
           'localidadComprador',
           'localidadVendedor',
           'procedencia',
           'lugarDestino',
           'producto',
           'transporte',
           'servicios',
           'servicios.metodoDescuento',
           'biotecnologias',
           'ensayosDescargas'
           //'calidad?'

        );


       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {

                case 'cartaPorte':
                    $query->where('carta_porte', $value);
                    break;

                case 'numeroCTG':
                    $query->where('numero_ctg', $value);
                    break;

                case 'corredorComprador_cuit':
                    $query->corredorComprador($value);
                    break;                          

                case 'corredorVendedor_cuit':
                    $query->corredorVendedor($value);
                    break;         

                case 'vendedor_cuit':
                    $query->vendedor($value);
                    break;       

                case 'comprador_cuit':
                    $query->comprador($value);
                    break;       

                case 'producto_codigo':
                    $query->producto($value);
                    break;                       

                case 'numeroContratoComprador':
                    $query->where('numero_contrato_corredor', $value);
                    break;
                case 'numeroContratoVendedor':
                    $query->where('numero_contrato_corredor', $value);
                    break;
                case 'numeroContratoCorredor':
                    $query->where('numero_contrato_corredor', $value);
                    break;

                case 'alfanumericoCupo':
                    $query->where('alfanumerico_cupo', $value);
                    break;
                /* FALTA DESTINO, NO SE DONDE ESTA EL COD PLANTA ONCA*/                 

                case 'fechaDescarga':
                    $query->whereDate('fecha_descarga', $value);
                    break;

                case 'fechaCargaDesde':
                    $query->whereDate('fecha_carga', '>=', $value);
                    break;
                case 'fechaCargaHasta':
                    $query->whereDate('fecha_carga', '<=', $value);
                    break;

                case 'statusCamionEnPuerto':
                    $query->where('numero_contrato_corredor', $value);
                    break;     
            }        
        }
        

        return new Descargas( $query->paginate($this->pageSize));

    }



}
