<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleComprobante extends Model
{
    protected $table = 'items_detalle_comprobantes';
    protected $primaryKey = 'id_item_detalle_comprobante';


    public function tipoItem(){
        return $this->hasOne('App\Models\TipoItem','id_tipo_item','id_tipo_item');
    }
}
