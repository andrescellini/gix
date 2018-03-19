<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Fijacion;
use App\Http\Resources\Fijaciones;
use App\Http\Requests\FijacionesRequest;

class FijacionesController extends Controller
{


    public function index(FijacionesRequest $request)
    {
       	
       	$query = Fijacion::query();

       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'fechaFijacionDesde':
                    $query->whereDate('fecha_fijacion', '>=', $value);
                    break;
                case 'fechaFijacionHasta':
                    $query->whereDate('fecha_fijacion', '<=', $value);
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
                case 'idInternoFijacionComprador':
                    $query->where('idInternoFijacionComprador', $value);
                    break;                    
            }        
        }

        return new Fijaciones( $query->paginate($this->pageSize));

    }



}
