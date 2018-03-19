<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Servicios extends ResourceCollection
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
                    "codigoTipoItemServicios"=> $c->id_tipo_item,
                    "metodoDescuentoServicio"=> $c->metodoDescuento->abreviatura,
                    "kilosDescuentoPorServicio"=> $c->kilos_descuento,
                ];
            });     

        return $salida; 
    }



    
}
