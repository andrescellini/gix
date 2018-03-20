<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interviniente extends Model
{
    protected $table = 'intervinientes';
    protected $primaryKey = 'id_interviniente';

    protected $casts = [
        'cuit' => 'double'
    ];
}
