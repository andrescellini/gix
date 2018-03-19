<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    protected $table = 'muestras';
    protected $primaryKey = 'id_muestra';

    protected $appends = ['datosAuxiliares'];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
    	return [];
    }
    
    public function getFechaDescargaAttribute($value){
    	return str_replace('-', '', $value);
    }


    /*relaciones*/

    public function producto()
    {
        return $this->hasOne('App\Models\Producto','id_producto','id_producto');
    }   

    public function vendedor(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_vendedor');
    }
    public function comprador(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_comprador');
    }

    public function corredor(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_corredor');
    }

    public function titular(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_titular');
    }
    public function intermediario(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_intermediario');
    }
    public function representante(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_representante');
    }

    public function puerto(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_puerto');
    }

    public function cuentaOrden()
    {
        return $this->hasMany('App\Models\CuentaOrden','id_muestra','id_muestra');
    }

    public function procedencia()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_procedencia');
    }   

    public function destino()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_destino');
    }   

    public function transporte()
    {
        return $this->hasOne('App\Models\Transporte','id_transporte','id_transporte');
    }   

    public function ensayosMuestras()
    {
        return $this->hasMany('App\Models\EnsayoMuestra','id_muestra','id_muestra');
    }



     
}

