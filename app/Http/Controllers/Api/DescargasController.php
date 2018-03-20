<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Descarga;
use App\Http\Resources\Descargas;
use App\Http\Requests\DescargasRequest;

class DescargasController extends Controller
{


      /**
     * @SWG\Get(
     *     path="/descargas",
     *     summary="Devuelve listado de descargas",
     *     tags={"descargas"},
     *     description="Devuelve un json con los descargas que el usuario logeado puede visualizar. ",
     *     operationId="descargas",
     *     produces={"application/json"},
     *     security={
     *       {"passport": {}},
     *     },    
     *     @SWG\Parameter(
     *         name="fechaCargaDesde",
     *         in="query",
     *         description="***UNIVOCO*** formato *AAAAMMDD*",
     *         format="AAAAMMDD",
     *         required=false,
     *         type="string",
     *     ),        
     *     @SWG\Parameter(
     *         name="fechaCargaHasta",
     *         in="query",
     *         description="***UNIVOCO*** formato *AAAAMMDD*",
     *         format="AAAAMMDD",
     *         required=false,
     *         type="string",
     *     ),             
     *     @SWG\Parameter(
     *         name="cartaPorte",
     *         in="query",
     *         description="***UNIVOCO***",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="numeroCTG",
     *         in="query",
     *         description="***UNIVOCO***",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="numeroContratoComprador",
     *         in="query",
     *         description="***UNIVOCO***",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="numeroContratoVendedor",
     *         in="query",
     *         description="***UNIVOCO***",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="numeroContratoCorredor",
     *         in="query",
     *         description="***UNIVOCO***",
     *         required=false,
     *         type="string",
     *     ),     
     *     @SWG\Parameter(
     *         name="alfanumericoCupo",
     *         in="query",
     *         description="***UNIVOCO***",
     *         required=false,
     *         type="string",
     *     ), 
     *     @SWG\Parameter(
     *         name="corredorComprador.cuit",
     *         in="query",
     *         description="",
     *         required=false,
     *         type="number",
     *     ),      
     *     @SWG\Parameter(
     *         name="corredorVendedor.cuit",
     *         in="query",
     *         description="",
     *         required=false,
     *         type="number",
     *     ),                         
     *     @SWG\Parameter(
     *         name="vendedor.cuit",
     *         in="query",
     *         description="",
     *         required=false,
     *         type="number",
     *     ),      
     *     @SWG\Parameter(
     *         name="comprador.cuit",
     *         in="query",
     *         description="",
     *         required=false,
     *         type="number",
     *     ),
     *     @SWG\Parameter(
     *         name="producto.codigo",
     *         in="query",
     *         description="",
     *         required=false,
     *         type="number",
     *     ),
        *     @SWG\Parameter(
     *         name="destino.codigoPlantaOncca",
     *         in="query",
     *         description="",
     *         required=false,
     *         type="number",
     *     ),         
     *     @SWG\Response(
     *         response=200,
     *         description="éxito",     
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="sin autorizacion",     
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="parametros de entrada inválidos",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="error inesperado por parte del api",
     *     )
     * )
     */

    public function index(DescargasRequest $request)
    {
       	
       	$query = Descarga::with(
           'titular',
           'intermediario',
           'remitenteComercial',
           'corredorComprador',
           'corredorVendedor',
           'mercadoaTermino',
           'intermediarioFlete',
           'entregador',
           'destinatario',
           'destino',
           'transportista',
           'chofer',
           'vendedor',
           'comprador',
           'vendedorTermino',
           'compradortermino',
           'corredorTermino',
           'localidadComprador',
           'localidadVendedor',
           'procedencia',
           'lugarDestino',
           'producto',
           'transporte',
           'servicios',
           'servicios.metodoDescuento',
           'biotecnologias',
           'ensayosDescargas'
        );


       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {

                case 'cartaPorte':
                    $query->where('carta_porte', $value);
                    break;

                case 'numeroCTG':
                    $query->where('numero_ctg', $value);
                    break;

                case 'corredorComprador_cuit':
                    $query->corredorComprador($value);
                    break;                          

                case 'corredorVendedor_cuit':
                    $query->corredorVendedor($value);
                    break;         

                case 'vendedor_cuit':
                    $query->vendedor($value);
                    break;       

                case 'comprador_cuit':
                    $query->comprador($value);
                    break;       

                case 'producto_codigo':
                    $query->producto($value);
                    break;                       

                case 'numeroContratoComprador':
                    $query->where('numero_contrato_corredor', $value);
                    break;
                case 'numeroContratoVendedor':
                    $query->where('numero_contrato_corredor', $value);
                    break;
                case 'numeroContratoCorredor':
                    $query->where('numero_contrato_corredor', $value);
                    break;

                case 'alfanumericoCupo':
                    $query->where('alfanumerico_cupo', $value);
                    break;
                /* FALTA DESTINO, NO SE DONDE ESTA EL COD PLANTA ONCA*/                 

                case 'fechaDescarga':
                    $query->whereDate('fecha_descarga', $value);
                    break;

                case 'fechaCargaDesde':
                    $query->whereDate('fecha_carga', '>=', $value);
                    break;
                case 'fechaCargaHasta':
                    $query->whereDate('fecha_carga', '<=', $value);
                    break;

                case 'statusCamionEnPuerto':
                    $query->where('numero_contrato_corredor', $value);
                    break;     
            }        
        }
        
        
        return new Descargas( $query->paginate($this->pageSize));

    }



}
