<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class CertificadosDepositos extends ResourceCollection
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
                    "depositante"=> [
                        "cuit" => $c->depositante->cuit,
                        "razonSocial" => $c->depositante->razon_social,
                    ],
                    "depositario"=> [
                        "cuit" => $c->depositario->cuit,
                        "razonSocial" => $c->depositario->razon_social,
                    ],
                    "laboratorio"=> [
                        "cuit" => $c->laboratorio->cuit,
                        "razonSocial" => $c->laboratorio->razon_social,
                    ],   
                    "origen"=> [
                        "codigoLocalidad" => $c->origen->codigo_sio,
                        "codigoPostalLocalidad" => $c->origen->codigo_postal,
                        "subcodigoPostalLocalidad" => $c->origen->subcodigo_postal,
                    ],
                    "entrega"=> [
                        "codigoLocalidad" => $c->entrega->codigo_sio,
                        "codigoPostalLocalidad" => $c->entrega->codigo_postal,
                        "subcodigoPostalLocalidad" => $c->entrega->subcodigo_postal,
                    ],    
                    "producto"=> [
                        "codigo" => $c->producto->codigo_producto,
                        "extension" => $c->id_extencion_producto,
                        "codigoCosecha" => $c->id_cosecha,
                    ],                     

                    "tipoLiquidacion" => $c->tipo_liquidacion ,
                    "numeroCertificado" => $c->numero_certificado ,
                    "numeroCaiCoe" => $c->numero_caicoe ,
                    "fechaCerificado" => $c->fecha_certificado ,
                    "grado" => $c->grado ,
                    "coeficienteGrado" => $c->coeficiente_grado ,
                    "factor" => $c->factor ,
                    "tarifaAlmacenaje" => $c->tarifa_almacenaje ,
                    "diasLibresAlmacenaje" => $c->dias_libres_almacenaje ,
                    "importeTotalServicios" => $c->importe_total_servicios ,
                    "codigoMonedaImporteTotalServicios" => $c->id_moneda_importe_total ,
                    "codigoEstablecimiento" => $c->codigo_establecimiento ,
                    "numeroAnalisis" => $c->numero_analisis ,
                    "numeroBoletin" => $c->numero_boletin ,
                    "fechaAnalisis" => $c->fecha_analisis ,
                    "porcentajeContenidoProteico" => $c->porcentaje_contenido_proteico ,
                    "kilosBrutos" => $c->kilos_brutos ,
                    "kilosMermaVolatil" => $c->kilos_merma_volatil ,
                    "kilosMermaZaranda" => $c->kilos_merma_zaranda ,
                    "kilosMermaSecada" => $c->kilos_merma_secada ,
                    "kilosNeto" => $c->kilos_neto ,


                    "cartasPorte" => new CartasPorteCertificados($c->cartasPorte),
                    "itemsDetalleServicios" => new DetallesServiciosCertificados($c->itemsDetalleServicios),
       


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
