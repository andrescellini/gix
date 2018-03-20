<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Http\Resources\Contratos;
use App\Http\Requests\ContratosRequest;

class ContratosController extends Controller
{


    /**
     * @SWG\Get(
     *     path="/contratos",
     *     summary="Devuelve listado de contratos",
     *     tags={"contratos"},
     *     description="Devuelve un json con los contratos que el usuario logeado puede visualizar. ",
     *     operationId="contratos",
     *     produces={"application/json"},
     *   security={
     *     {"passport": {}},
     *   },     
     *     @SWG\Parameter(
     *         name="numeroContratoComprador",
     *         in="query",
     *         description="***UNIVOCO*** - Nº contrato generado por parte del Comprador",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="numeroContratoVendedor",
     *         in="query",
     *         description="***UNIVOCO*** - Nº contrato generado por parte del Vendedor",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="numeroContratoCorredor",
     *         in="query",
     *         description="***UNIVOCO*** - Nº contrato generado por parte del Corredor",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="fechaContratoDesde",
     *         in="query",
     *         description="***UNIVOCO*** - FechaDesde de contrato, formato *AAAAMMDD*",
     *         format="AAAAMMDD",
     *         required=false,
     *         type="string",
     *     ),          
     *     @SWG\Parameter(
     *         name="fechaContratoHasta",
     *         in="query",
     *         description="***UNIVOCO*** - FechaHasta de contrato, formato *AAAAMMDD*",
     *         format="AAAAMMDD",
     *         required=false,
     *         type="string",
     *     ), 
     *     @SWG\Parameter(
     *         name="comprador.cuit",
     *         in="query",
     *         description="cuit del comprador",
     *         required=false,
     *         type="number",
     *     ),
     *     @SWG\Parameter(
     *         name="vendedor.cuit",
     *         in="query",
     *         description="cuit del vendedor",
     *         required=false,
     *         type="number",
     *     ),     
     *     @SWG\Parameter(
     *         name="corredor.cuit",
     *         in="query",
     *         description="cuit del corredor",
     *         required=false,
     *         type="number",
     *     ),
     *     @SWG\Parameter(
     *         name="producto.codigo",
     *         in="query",
     *         description="codigo del producto segun afip",
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

    public function index(ContratosRequest $request)
    {
       	
       	$query = Contrato::with('comprador',
   								'vendedor',
   								'corredor',
   								'procedencia',
   								'destino',
                                'producto',
   								'unidadMedida',
   								'actividadComprador',
   								'actividadVendedor');


       	
        foreach ($request->all() as $key => $value) {                
            switch ($key) {
                case 'comprador_cuit':
                    $query->comprador($value);
                    break;
                case 'vendedor_cuit':
                	$query->vendedor($value);
                    break;
                case 'corredor_cuit':
                	$query->corredor($value);
                    break;
                case 'producto_codigo':
                    $query->producto($value);
                    break;
                case 'fechaContratoDesde':
                    $query->whereDate('fecha_contrato', '>=', $value);
                    break;
                case 'fechaContratoHasta':
                    $query->whereDate('fecha_contrato', '<=', $value);
                    break;
                case 'numeroContratoComprador':
                    $query->where('numero_contrato_comprador', $value);
                    break;
                case 'numeroContratoVendedor':
                    $query->where('numero_contrato_vendedor', $value);
                    break;
                case 'numeroContratoCorredor':
                    $query->where('numero_contrato_corredor', $value);
                    break;
            }        
        }

        return new Contratos( $query->paginate($this->pageSize));

    }



}
