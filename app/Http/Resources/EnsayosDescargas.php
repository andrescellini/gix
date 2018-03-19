<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class EnsayosDescargas extends ResourceCollection
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
                    "codigoBolsa"=> $c->id_bolsa,
                    "codigoRubroCalidad1"=> $c->ensayo->codigoRubroCalidad1,
                    "codigoRubroCalidad2"=> $c->ensayo->codigoRubroCalidad2,
                    "codigoRubroCalidad3"=> $c->ensayo->codigoRubroCalidad3,
                    "codigoRubroCalidadGIX"=> $c->id_ensayo,
                    "tipoRubroCalidad"=> $c->id_tipo_rubro_calidad,
                    "kilosMermaRubroCalidad"=> $c->kilos_merma_rubro,
                    "camara"=> $c->id_camara,
                    "resultadoEnPlanta"=> $c->resultado_en_planta,
                    "factorRubroCalidad"=> $c->factor_rubro
                ];
            });     

        return $salida; 
    }



    
}
