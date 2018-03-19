<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Aplicacion;
use App\Http\Resources\Aplicaciones;
use App\Http\Requests\AplicacionesRequest;

class AplicacionesController extends Controller
{


    public function index(AplicacionesRequest $request)
    {
       	
       	$query = Aplicacion::query();

       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'fechaAplicacionDesde':
                    $query->whereDate('fecha_aplicacion', '>=', $value);
                    break;
                case 'fechaAplicacionHasta':
                    $query->whereDate('fecha_aplicacion', '<=', $value);
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
                case 'cartaPorte':
                    $query->where('carta_porte', $value);
                    break;
                case 'idInternoFijacionComprador':
                    $query->where('idInternoFijacionComprador', $value);
                    break;                    
            }        
        }

        return new Aplicaciones($query->paginate($this->pageSize));

    }



}
