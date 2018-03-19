<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Muestras extends ResourceCollection
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

        $salida = [
            
            'status' =>[
                "code" => 200,
                "mensaje" => "OK",
                "detalle" => "un detalle",
            ],

            'metadata' =>[
                "pageNumber" => $this->currentPage(),
                "pageSize" => $this->perPage(),
                "totalPages" => $this->lastPage(),
                "nextPageLink" => $this->nextPageUrl(),
                "lastPageLink" => $this->url($this->lastPage()),
            ],

            'data' => $this->collection->transform(function($c){
                return [
                    
                    "numeroMuestra" => $c->numero_muestra ,
 
                    "producto"=> [
                        "codigo" => $c->producto->codigo_producto,
                        "descripcion" => $c->producto->producto,
                    ],  

                    "comprador"=> [
                        "cuit" => $c->comprador->cuit,
                        "codigoSucursal" => $c->comprador->codigo_sucursal,
                        "razonSocial" => $c->comprador->razon_social,
                    ],
                    "vendedor"=> [
                        "cuit" => $c->vendedor->cuit,
                        "codigoSucursal" => $c->vendedor->codigo_sucursal,
                        "razonSocial" => $c->vendedor->razon_social,
                    ],
                    /* FALTA DEFINIR EN MUESTRA el interviniente corredor
                    "corredor"=> [
                        "cuit" => $c->corredor->cuit,
                        "codigoSucursal" => $c->corredor->codigo_sucursal,
                        "razonSocial" => $c->corredor->razon_social,
                    ],  
                      */
                   
                    "titular"=> $this->when($c->titular, function () use ($c) {
                        return [
                            "cuit" => $c->titular->cuit,
                            "codigoSucursal" => $c->titular->codigo_sucursal,
                            "razonSocial" => $c->titular->razon_social,
                        ];
                    }), 

                    "intermediario"=> $this->when($c->intermediario, function () use ($c) {
                        return [
                            "cuit" => $c->intermediario->cuit,
                            "codigoSucursal" => $c->intermediario->codigo_sucursal,
                            "razonSocial" => $c->intermediario->razon_social,
                        ];
                    }),                     

                    "representante"=> $this->when($c->representante, function () use ($c) {
                        return [
                            "cuit" => $c->representante->cuit,
                            "codigoSucursal" => $c->representante->codigo_sucursal,
                            "razonSocial" => $c->representante->razon_social,
                        ];
                    }),      

                     
                    "cuentaYOrden" => new CuentasOrden($c->CuentaOrden),
                    "codigoPagador" => $c->codigo_pagador ,
                    "procedencia"=> [
                        "codigoLocalidadONCCA" => $c->procedencia->codigo_oncca,
                        "codigoPostal" => $c->procedencia->codigo_postal,
                        "subCodigoPostal" => $c->procedencia->subcodigo_postal,
                    ],
                    "destino"=> [
                        "codigoLocalidadONCCA" => $c->destino->codigo_oncca,
                        "codigoPostal" => $c->destino->codigo_postal,
                        "subCodigoPostal" => $c->destino->subcodigo_postal,
                    ],    
                   
                    "numeroContratoVendedor" => $c->numero_contrato_comprador ,
                    "numeroContratoComprador" => $c->numero_contrato_vendedor ,
                    "numeroContratoCorredor"=> $c->numero_contrato_corredor ,
                    "fechaDescarga" => $c->fecha_descarga ,
                    "numeroReciboCliente" => $c->numero_recibo_cliente ,
                    "codigoPuerto" => $c->puerto->codigo_puerto ,
                    "pesoNetoSeco" => $c->peso_neto_seco ,
                    "lacrada"=> $c->lacrada ,
                    "servicioLacrado" => $c->servicio_lacrado ,
                    "grupoEnsayos" => $c->grupo_ensayos ,
                 
                    "transporte"=>[
                        "codigoMedioTransporte"=> $c->transporte->abreviatura,
                        "cartaPorte"=> $c->carta_porte,
                        "numeroCTG"=> $c->numero_ctg,
                        "patenteCamion"=> $c->patente_camion,
                        "patenteAcoplado"=> $c->patente_acoplado,
                        "identificadorVagon"=> $c->identificador_vagon,
                        "cantidadVagones"=> $c->cantidad_vagones,
                    ],
                    "ensayos" => new Ensayos($c->ensayosMuestras),
                    "codigoCosecha" =>  $c->id_cosecha,
                    "codigoBiotecnologia"=>  $c->id_biotecnologia,
                    "establecimiento" =>  $c->establecimiento,
                    
                    "datosAuxiliares" => $c->datosAuxiliares,
                    
                ];
            }),     
        ];       

        return $salida; 
    }

    public function withResponse($request, $response)
    {
        $originalContent = json_decode($response->content(),true);
        
        unset($originalContent['links'],$originalContent['meta']);
    
        $response->setData($originalContent);
    }

    
}
