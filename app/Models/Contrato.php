<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'id_contrato';

    protected $appends = ['datosAuxiliares'];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
    	return [];
    }
    
    public function getFechaContratoAttribute($value){
    	return str_replace('-', '', $value);
    }

    public function getFechaFijacionDesdeAttribute($value){
    	return str_replace('-', '', $value);
    }

    public function getFechaFijacionHastaAttribute($value){
    	return str_replace('-', '', $value);
    }

    public function getFechaConvenioPagoAttribute($value){
    	return str_replace('-', '', $value);
    }    

    /*relaciones*/

    public function comprador()
    {
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_comprador');
    }

    public function vendedor()
    {
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_vendedor');
    }

    public function corredor()
    {
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_corredor');
    }

    public function procedencia()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_procedencia');
    }

    public function destino()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_destino');
    }    
    
    public function producto()
    {
        return $this->hasOne('App\Models\Producto','id_producto','id_producto');
    }    

    public function actividadComprador()
    {
        return $this->hasOne('App\Models\Actividad','id_actividad','id_actividad_comprador');
    }    

    public function actividadVendedor()
    {
        return $this->hasOne('App\Models\Actividad','id_actividad','id_actividad_vendedor');
    }

    
    /*filtros*/
    
    public function scopeVendedor ($query, $cuit) {
	    return $query->whereHas('vendedor', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}

	public function scopeComprador ($query, $cuit) {
	    return $query->whereHas('comprador', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}

	public function scopeCorredor ($query, $cuit) {
	    return $query->whereHas('corredor', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}	

	public function scopeProducto ($query, $codigo_producto) {
	    return $query->whereHas('producto', function ($q) use ($codigo_producto) {
	            $q->where('codigo_producto', $codigo_producto);
	    });
	}
}

