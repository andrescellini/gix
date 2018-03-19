<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaOrden extends Model
{
    protected $table = 'cuenta_y_orden_muestras';
    protected $primaryKey = 'id_muestra';

    public function interviniente(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente');
    }
}
