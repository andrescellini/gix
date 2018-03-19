<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Comprobantes extends ResourceCollection
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
                    "emisorComprobante"=> [
                        "cuit" => $c->emisor->cuit,
                        "razonSocial" => $c->emisor->razon_social,
                    ],
                    "destinatarioComprobante"=> [
                        "cuit" => $c->destinatario->cuit,
                        "razonSocial" => $c->destinatario->razon_social,
                    ],
                    "codigoComprobante"=> $c->id_comprobante,
                    "codigoTipoComprobante"=> $c->id_tipo_comprobante,
                    "letraComprobante"=> $c->letra_comprobante,
                    "sucursalComprobante"=> $c->sucursal_comprobante,
                    "numeroComprobante"=> $c->numero_comprobante,
                    "numeroCaiCoe"=> $c->numero_caicoe,
                    "fechaComprobante"=> $c->fecha_comprobante,
                    "fechaVencimiento"=> $c->fecha_vencimiento,
                    "numeroContratoComprador"=> $c->numero_contrato_comprador,
                    "numeroContratoVendedor"=> $c->numero_contrato_vendedor,
                    "numeroContratoCorredor"=> $c->numero_contrato_corredor,
                    "IdInternoFijacionComprador"=> $c->id_fijacion_comprador,
                    "kilosComprobante"=> $c->kilos_comprobante,
                    "precioProducto"=> $c->precio_producto,
                    "codigoMonedaPrecio"=> $c->id_moneda,
                    "tipoCambio"=> $c->tipo_cambio,
                    "porcentajeAlicuotaIvaProducto"=> $c->porcentaje_alicuota_iva_producto,
                    "porcentajeMercaderia"=> $c->porcentaje_mercaderia,
                    "factor"=> $c->factor,
                    "importeTotalComprobante"=> $c->importe_total_comprobante,
                    "codigoMonedaImporteTotalComprobante"=> $c->id_moneda_importe_total,
                    "codigoComprobanteQueAnula"=> $c->id_tipo_comprobante_afip_anula,
                    "fechaComprobanteQueAnula"=> $c->letra_comprobante_anula,
                    "letraComprobanteQueAnula"=> $c->sucursal_comprobante_anula,
                    "sucursalComprobanteQueAnula"=> $c->numero_comprobante_anula,
                    "numeroComprobanteQueAnula"=> $c->fecha_comprobante_anula,

                    "itemsDetalleComprobante" => new DetallesComprobantes($c->detalles),
                    "certificadoDeposito" => new CertificadosDepositoComprobantes($c->certificadosDepositoComprobante),
                    "parcialesIncluidasEnFinal" => new Parciales($c->parciales),
                    "retenciones" => new Retenciones($c->retenciones),
                    "percepciones" => new Percepciones($c->percepciones),


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
