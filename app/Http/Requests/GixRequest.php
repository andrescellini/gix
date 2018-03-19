<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


class GixRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge($this->noUnivocos,$this->fechas,$this->univocos,['page' => 'integer|min:1']);  
    }


    public function withValidator($validator)
	{
			
		$parametros = request()->all();
	
		/* parametros desconocidos */

		if($desconocidos = array_except($parametros, array_keys($this->rules()))){

			throw new UnprocessableEntityHttpException('parametros desconocidos: ' . json_encode(array_keys($desconocidos)));

		}

		/* si detecto ya un parametro univoco, no valido nada mas */

		if( array_intersect(array_keys($this->univocos), array_keys($parametros))){

			return true;

		}

		/* siempre al menos 1 filtro */

		if(!array_except($parametros, ['page'])){

			throw new UnprocessableEntityHttpException('debe incluir al menos un parametro');	

		};


		/* valido que las fechas sean de a pares*/

		$fechas = array_intersect(array_keys($this->fechas), array_keys($parametros));

		if( $fechas && count($fechas) != count($this->fechas) ){

			throw new UnprocessableEntityHttpException('los parametros de fechas claves deben venir siempre de a pares');	

		}
	
		/* validaciones no univocos con fechas requeridas*/

		$noUnivocos = array_intersect(array_keys($this->noUnivocos), array_keys($parametros));

		if(	$noUnivocos && count(array_intersect(array_keys($this->fechas), array_keys($parametros) )) != count($this->fechas) ){

			throw new UnprocessableEntityHttpException('parametros no univocos sin campos de fechas requeridos ' . json_encode($noUnivocos));

		};

	}

}
