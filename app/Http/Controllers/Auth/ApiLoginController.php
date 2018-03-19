<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Infrastructure\Auth\LoginProxy;
use App\Infrastructure\Auth\Requests\LoginRequest;
use App\Infrastructure\Auth\Requests\RefreshRequest;
use App\Http\Controllers\Controller;

class ApiLoginController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

      /**
     * @SWG\Post(
     *     path="/login",
     *     tags={"autenticacion"},
     *     operationId="login",
     *     summary="login",
    *     security={
     *     {"passport": {}},
     *   },
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="email y password",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Login"),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="ok",
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="error en parametros",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="error inesperado",
     *     ),
     * )
     */

     

    public function login(LoginRequest $request)
    {
        
        if(!$request->has('email')){
            $email = $request->get('username');
        }else{
            $email = $request->get('email');
        }
        
        $password = $request->get('password');

        return response($this->loginProxy->attemptLogin($email, $password), 200);
    }

    /**
     * @SWG\Post(
     *     path="/refresh",
     *     tags={"autenticacion"},
     *     operationId="refresh",
     *     summary="refresh",
    *     security={
     *     {"passport": {}},
     *   },
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="token",
     *         in="body",
     *         description="token para refrescar",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Refresh"),
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="ok",
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="error en parametros",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="error inesperado",
     *     ),
     * )
     */
    public function refresh(RefreshRequest $request)
    {
        $token = $request->get('refresh_token');

        return response($this->loginProxy->attemptRefresh($token), 200);
    }

          /**
     * @SWG\Post(
     *     path="/logout",
     *     tags={"autenticacion"},
     *     operationId="logout",
     *     summary="logout",
    *     security={
     *     {"passport": {}},
     *   },
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response="200",
     *         description="ok",
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="error en parametros",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="error inesperado",
     *     ),
     * )
     */
    public function logout()
    {
        $this->loginProxy->logout();

        return response(null, 204);
    }

            /**
     * @SWG\Get(
     *     path="/user",
     *     tags={"autenticacion"},
     *     security={
     *     {"passport": {}},
     *   },
     *     summary="Retorna el usuario logeado",
     *     description="",
     *     operationId="user",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response="200",
     *         description="ok",
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="error en parametros",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="error inesperado",
     *     ),
     * )
     */
    public function user(Request $request){
        return $request->user();
    }
}