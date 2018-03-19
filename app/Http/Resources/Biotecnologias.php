<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Biotecnologias extends ResourceCollection
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
                    "codigoBiotecnologia"=> $c->id_biotecnologia,
                    "Porcentaje"=> $c->porcentaje

                ];
            });     

        return $salida; 
    }



    
}
