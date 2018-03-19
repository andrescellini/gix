<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fijacion extends Model
{
    protected $table = 'fijaciones';
    protected $primaryKey = 'id_fijacion';

    protected $appends = ['datosAuxiliares'];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
    	return [];
    }
    
    public function getFechaFijacionAttribute($value){
    	return str_replace('-', '', $value);
    }

}

