<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CertificadosDepositoComprobantes extends ResourceCollection
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

        $salida = 

            $this->collection->transform(function($c){
                return [
                    "numero"=> $c->numero_certificado,
                    "tipo"=> $c->tipo_liquidacion,
                    "kilosAplicados"=> $c->kilos_aplicados
                ];
            });     

        return $salida; 
    }



    
}
