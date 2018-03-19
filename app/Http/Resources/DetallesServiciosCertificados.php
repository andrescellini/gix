<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class DetallesServiciosCertificados extends ResourceCollection
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
                       "codigoTipoItem" => $c->id_tipo_item ,
                       "descripcionTipoItem" => $c->tipoItem->tipo_item ,
                       "cantidad" => $c->cantidad ,
                       "importeExento" => $c->importe_exento ,
                       "importeNetoGravado" => $c->importe_neto_gravado ,
                       "porcentajeAlicuotaIva" => $c->porcentaje_alicuota_iva ,
                       "importeIva" => $c->importe_iva ,
                       "importeTotal" => $c->importe_total 

                ];
            });     

        return $salida; 
    }



    
}
