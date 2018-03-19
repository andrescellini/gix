<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios_descargas';
    protected $primaryKey = 'id_descarga';

    
    public function metodoDescuento(){
        return $this->hasOne('App\Models\MetodoDescuento','id_metodo_descuento','id_metodo_descuento');
    }

}
