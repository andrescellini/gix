<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Aplicaciones extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $with = [];

    public function toArray($request)
    {

        $salida = [
            
            'status' =>[
                "code" => 200,
                "mensaje" => "OK",
                "detalle" => "un detalle",
            ],

            'metadata' =>[
                "pageNumber" => $this->currentPage(),
                "pageSize" => $this->perPage(),
                "totalPages" => $this->lastPage(),
                "nextPageLink" => $this->nextPageUrl(),
                "lastPageLink" => $this->url($this->lastPage()),
            ],

            'data' => $this->collection->transform(function($a){
                return [
                        "cartaPorte"=> $a->carta_porte,
                        "numeroContratoComprador"=> $a->numero_contrato_comprador,
                        "numeroContratoVendedor"=> $a->numero_contrato_comprador,
                        "numeroContratoCorredor"=> $a->numero_contrato_corredor,
                        "idInternoFijacionComprador"=> $a->id_fijacion_comprador,
                        "kilosAplicados"=> $a->kilos_aplicados,
                        "fechaAplicacion"=> $a->fecha_aplicacion,
                        "datosAuxiliares" => $a->datosAuxiliares,
                ];
            })    
        ];       

        return $salida; 
    }

    public function withResponse($request, $response)
    {
        $originalContent = json_decode($response->content(),true);
        
        unset($originalContent['links'],$originalContent['meta']);
    
        $response->setData($originalContent);
    }

    
}
