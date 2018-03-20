<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'id_contrato';

    protected $appends = ['datosAuxiliares'];

    protected $dates = [
        'fecha_contrato',
        'fecha_fijacion_desde',
        'fecha_fijacion_hasta',
        'fecha_entrega_desde',
        'fecha_entrega_hasta',        
        'fecha_convenida_pago',
    ];   
    
    protected $casts = [
        'id_bolsa' => 'integer',
        'cantidad_desde' => 'integer',
        'cantidad_hasta' => 'integer',
        'cantidad_camiones' => 'integer',
        'porcentaje_mercaderia_parcial' => 'float',
        'precio' => 'float',
        'cantidad_fijacion_minima' => 'integer',
        'cantidad_fijacion_maxima' => 'integer',
        'codigo_registracion_AFIP' => 'integer',
    ];
   

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
    public function unidadMedida()
    {
        return $this->hasOne('App\Models\UnidadMedida','id_unidad_medida','id_unidad_medida');
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

