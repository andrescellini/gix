<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificadoDeposito extends Model
{
    protected $table = 'certificados_depositos';
    protected $primaryKey = 'id_certificado_deposito';

    protected $appends = ['datosAuxiliares'];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
        return [];
    }
    
    public function getFechaCertificadoAttribute($value){
        return str_replace('-', '', $value);
    }

    public function getFechaAnalisisAttribute($value){
        return str_replace('-', '', $value);
    }

    public function depositante(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_depositante');
    }
    public function depositario(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_depositario');
    }
    public function laboratorio(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_laboratorio');
    }
    public function producto()
    {
        return $this->hasOne('App\Models\Producto','id_producto','id_producto');
    }   

    public function origen()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_origen');
    }

    public function entrega()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_entrega');
    }    

    public function cartasPorte()
    {
        return $this->hasMany('App\Models\CartaPorteCertificado','id_certificado_deposito','id_certificado_deposito');
    }

    public function itemsDetalleServicios()
    {
        return $this->hasMany('App\Models\DetalleServicioCertificado','id_certificado_deposito','id_certificado_deposito');
    }
    

    /*filtros*/
    
    public function scopeDepositante ($query, $cuit) {
	    return $query->whereHas('depositante', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}

	public function scopeDepositario ($query, $cuit) {
	    return $query->whereHas('depositario', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}

	public function scopeProducto ($query, $codigo_producto) {
	    return $query->whereHas('producto', function ($q) use ($codigo_producto) {
	            $q->where('codigo_producto', $codigo_producto);
	    });
	}	

	public function scopeCartaPorte ($query, $cp) {
	    return $query->whereHas('cartasPorte', function ($q) use ($cp) {
	            $q->where('carta_porte', $cp);
	    });
	}	

	public function scopeNumeroCTG ($query, $cp) {
	    return $query->whereHas('cartasPorte', function ($q) use ($cp) {
	            $q->where('numero_ctg', $cp);
	    });
	}		
}
