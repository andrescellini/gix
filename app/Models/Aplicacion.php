<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aplicacion extends Model
{
    protected $table = 'aplicaciones';
    protected $primaryKey = 'id_aplicacion';

    protected $appends = ['datosAuxiliares'];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
    	return [];
    }
    
    public function getFechaAplicacionAttribute($value){
    	return str_replace('-', '', $value);
    }

}

