<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Descargas extends ResourceCollection
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
                "totalRecords" => $this->total(),
            ],

            'data' => $this->collection->transform(function($d){
                return [
                  "cartaPorte"=> $d->carta_porte,
                  "numeroCEE"=> $d->numero_CEE,
                  "fechaCarga"=> $d->fecha_carga->toIso8601String(),
                  "fechaVencimiento"=> $d->fecha_vencimiento->toIso8601String(),
                  "numeroCTG"=> $d->numero_ctg,
                  "titular"=> [ 
                     "cuit"=> $d->titular->cuit,
                     "razonSocial"=> $d->titular->razon_social,
                  ],

                  "intermediario"=> $this->when($d->intermediario, function () use ($d) {
                        return [
                            "cuit" => $d->intermediario->cuit,
                            "razonSocial" => $d->intermediario->razon_social,
                        ];
                    }), 

                  "remitenteComercial"=> $this->when($d->remitenteComercial, function () use ($d) {
                        return [
                            "cuit" => $d->remitenteComercial->cuit,
                            "razonSocial" => $d->remitenteComercial->razon_social,
                        ];
                    }),                   


                  "remitenteComercialActuaComoProductor"=> '???',

                  "corredorComprador"=> $this->when($d->corredorComprador, function () use ($d) {
                        return [
                            "cuit" => $d->corredorComprador->cuit,
                            "razonSocial" => $d->corredorComprador->razon_social,
                        ];
                    }),    
                  "corredorVendedor"=> $this->when($d->corredorVendedor, function () use ($d) {
                        return [
                            "cuit" => $d->corredorVendedor->cuit,
                            "razonSocial" => $d->corredorVendedor->razon_social,
                        ];
                    }),    
                  "mercadoaTermino"=> $this->when($d->mercadoaTermino, function () use ($d) {
                        return [
                            "cuit" => $d->mercadoaTermino->cuit,
                            "razonSocial" => $d->mercadoaTermino->razon_social,
                        ];
                    }),                                                              
                  "intermediarioFlete"=> $this->when($d->intermediarioFlete, function () use ($d) {
                        return [
                            "cuit" => $d->intermediarioFlete->cuit,
                            "razonSocial" => $d->intermediarioFlete->razon_social,
                        ];
                    }),    

                  "entregador"=> $this->when($d->entregador, function () use ($d) {
                        return [
                            "cuit" => $d->entregador->cuit,
                            "razonSocial" => $d->entregador->razon_social,
                        ];
                    }),    

                  "destinatario"=> [ 
                     "cuit"=> $d->destinatario->cuit,
                     "razonSocial"=> $d->destinatario->razon_social,
                  ],                     
                  "destino"=> [ 
                     "cuit"=> $d->destino->cuit,
                     "razonSocial"=> $d->destino->razon_social,
                  ],      
                  "transportista"=> [ 
                     "cuit"=> $d->transportista->cuit,
                     "razonSocial"=> $d->transportista->razon_social,
                  ],      
                  "chofer"=> [ 
                     "cuit"=> $d->chofer->cuit,
                     "razonSocial"=> $d->chofer->razon_social,
                  ],      
                  "vendedor"=> [ 
                     "cuit"=> $d->vendedor->cuit,
                     "razonSocial"=> $d->vendedor->razon_social,
                  ],                                                       
                  "comprador"=> [ 
                     "cuit"=> $d->comprador->cuit,
                     "razonSocial"=> $d->comprador->razon_social,
                  ],      

                  "vendedorTermino"=> $this->when($d->vendedorTermino, function () use ($d) {
                        return [
                            "cuit" => $d->vendedorTermino->cuit,
                            "razonSocial" => $d->vendedorTermino->razon_social,
                        ];
                    }),    
                  "compradortermino"=> $this->when($d->compradortermino, function () use ($d) {
                        return [
                            "cuit" => $d->compradortermino->cuit,
                            "razonSocial" => $d->compradortermino->razon_social,
                        ];
                    }),    
                  "corredorTermino"=> $this->when($d->corredorTermino, function () use ($d) {
                        return [
                            "cuit" => $d->corredorTermino->cuit,
                            "razonSocial" => $d->corredorTermino->razon_social,
                        ];
                    }),    

                  "localidadVendedor"=> [
                        "codigoLocalidad" => $d->localidadVendedor->codigo_sio,
                        "codigoPostalLocalidad" => $d->localidadVendedor->codigo_postal,
                        "subcodigoPostalLocalidad" => $d->localidadVendedor->subcodigo_postal,
                    ],
                    "localidadComprador"=> [
                        "codigoLocalidad" => $d->localidadComprador->codigo_sio,
                        "codigoPostalLocalidad" => $d->localidadComprador->codigo_postal,
                        "subcodigoPostalLocalidad" => $d->localidadComprador->subcodigo_postal,
                    ],

                  "procedencia"=> [
                       "establecimiento"=>'???',
                       "codigoPlantaOncca"=>  '???',
                       "direccion"=>  '???',
                        "codigoLocalidad" => $d->procedencia->codigo_sio,
                        "codigoPostalLocalidad" => $d->procedencia->codigo_postal,
                        "subcodigoPostalLocalidad" => $d->procedencia->subcodigo_postal,
                        "codigoProvincia" => $d->procedencia->id_provincia,
                    ],

                    "lugarDestino"=> [
                        "codigoPlantaOncca"=>  '???',
                        "direccion"=>  '???',
                        "codigoLocalidad" => $d->lugarDestino->codigo_sio,
                        "codigoPostalLocalidad" => $d->lugarDestino->codigo_postal,
                        "codigoProvincia" => $d->lugarDestino->id_provincia,
                    ],

                    "producto"=> [
                        "codigo" => $d->producto->codigo_producto,
                        "extension" => $d->id_extencion_producto,
                        "codigoCosecha" => $d->id_cosecha,
                    ],  

                     "transporte"=>[
                        "incisoCTG "=> $d->inciso_ctg,
                        "codigoMedioTransporte"=> $d->transporte->abreviatura,
                        "patenteCamion"=> $d->patente_camion,
                        "patenteAcoplado"=> $d->patente_acoplado,
                        "numeroVagonOBarcaza"=> $d->identificador_vagon,
                        "nombreOperativoOConvoy"=> $d->numero_vagon,
                      ],

                      "numeroContratoVendedor" => $d->numero_contrato_vendedor,
                      "numeroContratoComprador" => $d->numero_contrato_comprador,
                      "numeroContratoCorredor" => $d->numero_contrato_corredor,
                      "kilosBrutosOrigen" => $d->kilos_brutos_origen,
                      "kilosTaraOrigen" => $d->kilos_tara_origen,
                      "kilosNetoOrigen" => $d->kilos_neto_origen,
                      "observacionesEnCartaPorte" => $d->observaciones_carta_porte,
                      "observacionesGenerales" => $d->observaciones_generales,
                      "alfanumericoCupo" => $d->alfanumerico_cupo,
                      "kmARecorrer" => $d->km_a_recorrer,
                      "statusCamionEnPuerto" => $d->id_estado_descarga,
                      "fechaDescarga" => $d->fecha_descarga->toIso8601String(),
                      "kilosBrutosDestino" => $d->kilos_brutos_destino,
                      "kilosTaraDestino" => $d->kilos_tara_destino,
                      "kilosNetoDestino" => $d->kilos_neto_destino,
                      "porcentajeHumedad" => $d->porcentaje_humedad,
                      "kilosMermaHumedad" => $d->kilos_merma_humedad,
                      "kilosMermaCalidad" => $d->kilos_merma_calidad,
                      "kilosMermaVolatil" => $d->kilos_merma_volatil,
                      "kilosMermaZaranda" => $d->kilos_merma_zaranda,
                      "kilosFinalesDescarga" => $d->kilos_finales_descarga,
                      "kilosConfirmadosDefinitivosCTG" => $d->kilos_confirmados_definitivos_ctg,
                      "fechaConfirmacionCTG" => $d->fecha_confirmacion_ctg->toIso8601String(),
                      "conformidad" => $d->id_conformidad,
                      "codigoBolsaAnalisisCalidad" => $d->id_bolsa,
                      "grado" => $d->grado,

                      "calidad" => new EnsayosDescargas($d->ensayosDescargas),
                      "servicios" => new Servicios($d->servicios),
                      "biotecnologia" => new Biotecnologias($d->biotecnologias),

                  "datosAuxiliares" => $d->datosAuxiliares,

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
