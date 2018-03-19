<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnsayoDescarga extends Model
{
    protected $table = 'ensayos_descargas';
    protected $primaryKey = 'id_descarga';

    protected $casts = [
        'factor_rubro' => 'float',
        'kilos_merma_rubro' => 'integer',
    ];

    public function ensayo(){
        return $this->hasOne('App\Models\Ensayo','id_ensayo','id_ensayo');
    }

}
