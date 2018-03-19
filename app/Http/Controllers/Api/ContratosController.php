<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Http\Resources\Contratos;
use App\Http\Requests\ContratosRequest;

class ContratosController extends Controller
{


    public function index(ContratosRequest $request)
    {
       	
       	$query = Contrato::with('comprador',
   								'vendedor',
   								'corredor',
   								'procedencia',
   								'destino',
   								'producto',
   								'actividadComprador',
   								'actividadVendedor');


       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'comprador_cuit':
                    $query->comprador($value);
                    break;
                case 'vendedor_cuit':
                	$query->vendedor($value);
                    break;
                case 'corredor_cuit':
                	$query->corredor($value);
                    break;
                case 'producto_codigo':
                    $query->producto($value);
                    break;
                case 'fechaContratoDesde':
                    $query->whereDate('fecha_contrato', '>=', $value);
                    break;
                case 'fechaContratoHasta':
                    $query->whereDate('fecha_contrato', '<=', $value);
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

        return new Contratos( $query->paginate($this->pageSize));

    }



}
