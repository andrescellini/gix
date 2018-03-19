<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class DetallesComprobantes extends ResourceCollection
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
                    "codigo"=> $c->id_tipo_item,
                    "descripcion"=> $c->tipoItem->tipo_item,
                    "cantidad"=> $c->cantidad,
                    "importeExento"=> (float) $c->importe_exento,
                    "importeNetoGravado"=> $c->importe_neto_gravado,
                    "porcentajeAlicuotaIva"=> $c->porcentaje_alicuota_iva,
                    "importeIva"=> $c->importe_iva,
                    "importeTotal"=> $c->importe_total,

                ];
            });     

        return $salida; 
    }



    
}
