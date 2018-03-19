<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Ensayos extends ResourceCollection
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
                    "id" => $c->ensayo->id_ensayo ,
                    "tipo" => $c->ensayo->codigoRubroCalidad1 ,
                    "codigo" => $c->ensayo->codigoRubroCalidad2 
                ];
            });     

        return $salida; 
    }



    
}
