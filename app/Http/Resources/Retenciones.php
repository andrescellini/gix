<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Retenciones extends ResourceCollection
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
                  "codigoTipoImpuesto"=> $c->id_tipo_impuesto,
                  "codigoJurisdiccion"=> $c->id_juridiccion ,
                  "codigoRegimen"=> $c->id_regimen ,
                  "importe"=> $c->importe ,

                ];
            });     

        return $salida; 
    }



    
}
