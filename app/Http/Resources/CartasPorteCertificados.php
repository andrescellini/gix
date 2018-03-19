<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CartasPorteCertificados extends ResourceCollection
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
                    "numeroCTG" => $c->numero_ctg ,
                    "cartaPorte" => $c->carta_porte ,
                    "kilosCertificados" => $c->kilos_certificados 


                ];
            });     

        return $salida; 
    }



    
}
