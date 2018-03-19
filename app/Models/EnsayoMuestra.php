<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnsayoMuestra extends Model
{
    protected $table = 'ensayos_muestras';
    protected $primaryKey = 'id_muestra';

    public function ensayo(){
        return $this->hasOne('App\Models\Ensayo','id_ensayo','id_ensayo');
    }


}
