<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CuentasOrden extends ResourceCollection
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
                    "cuit" => $c->interviniente->cuit ,
                    "codigoSucursal" => $c->interviniente->codigo_sucursal ,
                    "razonSocial" => $c->interviniente->razon_social 
                ];
            });     

        return $salida; 
    }



    
}
