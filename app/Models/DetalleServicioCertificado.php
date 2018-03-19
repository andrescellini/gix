<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleServicioCertificado extends Model
{
    protected $table = 'items_detalle_certificados_depositos';
    protected $primaryKey = 'id_item_detalle_certificado_deposito';


    public function tipoItem()
    {
        return $this->hasOne('App\Models\TipoItem','id_tipo_item','id_tipo_item');
    }
    
}
