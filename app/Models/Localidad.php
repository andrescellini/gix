<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';
    protected $primaryKey = 'id_localidad';

    protected $casts = [
        'codigo_sio' => 'integer',
        'codigo_oncca' => 'integer',
        'codigo_postal' => 'integer',
        'subcodigo_postal' => 'integer',
        'id_provincia' => 'integer',
    ];    

    public function provincia()
    {
        return $this->hasOne('App\Models\Provincia','id_provincia','id_provincia');
    }   
}
