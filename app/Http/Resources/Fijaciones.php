<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Fijaciones extends ResourceCollection
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

            'data' => $this->collection->transform(function($f){
                return [
                        "numeroContratoComprador"=> $f->numero_contrato_comprador,
                        "numeroContratoVendedor"=> $f->numero_contrato_vendedor,
                        "numeroContratoCorredor"=> $f->numero_contrato_corredor,
                        "fechaFijacion"=> $f->fecha_fijacion,
                        "kilosFijados"=> $f->kilos_fijados,
                        "precio"=> $f->precio,
                        "codigoMonedaPrecio"=> $f->id_moneda,
                        "idInternoFijacionComprador"=> $f->id_fijacion_comprador,
                        "datosAuxiliares" => $f->datosAuxiliares,
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
