<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Muestra;
use App\Http\Resources\Muestras;
use App\Http\Requests\MuestrasRequest;

class MuestrasController extends Controller
{


    public function index(MuestrasRequest $request)
    {
       	
       	$query = Muestra::with(
            'producto',
            'vendedor',
            'comprador',
            'corredor',
            'titular',
            'intermediario',
            'representante',
            'cuentaOrden.interviniente',
            'procedencia',
            'destino',
            'transporte',
            'ensayosMuestras.ensayo'

        );

       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'fechaDescargaDesde':
                    $query->whereDate('fecha_descarga', '>=', $value);
                    break;
                case 'fechaDescargaHasta':
                    $query->whereDate('fecha_descarga', '<=', $value);
                    break;
                case 'numeroMuestra':
                    $query->where('numero_muestra', $value);
                    break;
                case 'cartaPorte':
                    $query->where('carta_porte', $value);
                    break;
            }        
        }

        
        return new Muestras($query->paginate($this->pageSize));

        
    }



}
