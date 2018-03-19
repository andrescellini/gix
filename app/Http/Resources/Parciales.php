<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Parciales extends ResourceCollection
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
                      "codigo"=> $c->id_tipo_comprobante_afip,
                      "letra"=> $c->letra_comprobante,
                      "sucursal"=> $c->sucursal_comprobante,
                      "numeroComprobanteParcial"=> $c->numero_comprobante_parcial ,
                      "numeroCoe"=> $c->numero_coe 

                ];
            });     

        return $salida; 
    }



    
}
