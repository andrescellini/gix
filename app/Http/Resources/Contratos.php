<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class Contratos extends ResourceCollection
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
                    "comprador"=> [
                        "cuit" => $c->comprador->cuit,
                        "razonSocial" => $c->comprador->razon_social,
                    ],
                    "vendedor"=> [
                        "cuit" => $c->vendedor->cuit,
                        "razonSocial" => $c->vendedor->razon_social,
                    ],
                    "corredor"=> [
                        "cuit" => $c->corredor->cuit,
                        "razonSocial" => $c->corredor->razon_social,
                    ],
                    "codigoActividadComprador" => $c->actividadComprador->codigo_actividad,
                    "codigoActividadVendedor" => $c->actividadVendedor->codigo_actividad,
                    "procedencia"=> [
                        "codigoLocalidad" => $c->procedencia->codigo_sio,
                        "codigoPostalLocalidad" => $c->procedencia->codigo_postal,
                        "subcodigoPostalLocalidad" => $c->procedencia->subcodigo_postal,
                        "codigoProvincia" => $c->procedencia->id_provincia,                       
                    ],
                    "destino"=> [
                        "codigoLocalidad" => $c->destino->codigo_sio,
                        "codigoPostalLocalidad" => $c->destino->codigo_postal,
                        "subcodigoPostalLocalidad" => $c->destino->subcodigo_postal,
                        "codigoProvincia" => $c->destino->id_provincia,
                        
                    ],
                    "producto"=> [
                        "codigo" => $c->producto->codigo_producto,
                        "extension" => $c->id_extencion_producto,
                        "codigoCosecha" => $c->id_cosecha,
                        "codigoCondicionesCalidad" => '???',
                        
                    ],  

                    "codigoBolsa" => $c->id_bolsa,
                    "fechaContrato" => $c->fecha_contrato->toIso8601String(),
                    "numeroContratoComprador" => $c->numero_contrato_comprador,
                    "numeroContratoVendedor" => $c->numero_contrato_vendedor,
                    "numeroContratoCorredor" => $c->numero_contrato_corredor,
                    "codigoUnidadMedida" => $c->unidadMedida->unidad_medida,
                    "cantidadDesde" => $c->cantidad_desde,
                    "cantidadHasta" => $c->cantidad_hasta,
                    "codigoAjuste" => $c->id_ajuste,
                    "cantidadCamiones" => $c->cantidad_camiones,
                    "codigoMedioTransporte" => $c->id_transporte,
                    "codigoAPrecio" => $c->id_a_precio,
                    "codigoTipoContrato" => $c->id_tipo_contrato,
                    "codigoTipoOperacion" => $c->id_tipo_operacion,
                    "codigoMercaderiaOperacionPropia" => $c->id_mercaderia_operacion_propia,
                    "codigoModalidadOperacion" => $c->id_modalidad_operacion,
                    "codigoEsCompradorFinal" => $c->es_comprador_final,
                    "porcentajeMercaderiaParcial" => $c->porcentaje_mercaderia_parcial,
                    "fechaEntregaDesde" => $c->fecha_entrega_desde->toIso8601String(),
                    "fechaEntregaHasta" => $c->fecha_entrega_hasta->toIso8601String(),
                    "codigoCondicionPago" => $c->id_condicion_pago,
                    "codigoOpcionFijacion" => $c->id_opcion_fijacion,
                    "precio" => $c->precio,
                    "codigoMoneda" => $c->id_moneda,
                    "fechaConvenidaPago" => $c->fecha_convenida_pago->toIso8601String(),
                    "cantidadFijcionMinima" => $c->cantidad_fijacion_minima,
                    "cantidadFijcionMaxima" => $c->cantidad_fijacion_maxima,
                    "codigoUnidadMedidaFijacion" => $c->id_unidad_medida_fijacion,
                    "codigoFijacionPeriodo" => $c->id_frecuencia_fijacion,
                    "fechaFijcionDesde" => $c->fecha_fijacion_desde->toIso8601String(),
                    "fechaFijacionHasta" => $c->fecha_fijacion_hasta->toIso8601String(),
                    "codigoRegistracionAFIP" => $c->codigo_registracion_AFIP,
                    "observaciones" => $c->observaciones,

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
