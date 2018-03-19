<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table = 'comprobantes';
    protected $primaryKey = 'id_comprobante';

    protected $appends = ['datosAuxiliares'];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
    	return [];
    }
    
    public function getFechaComprobanteAttribute($value){
    	return str_replace('-', '', $value);
    }

    public function getFechaVencimientoAttribute($value){
    	return str_replace('-', '', $value);
    }


    /*relaciones*/

    public function emisor()
    {
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_emisor');
    }

    public function destinatario()
    {
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_destinatario');
    }

  
    public function detalles()
    {
        return $this->hasMany('App\Models\DetalleComprobante','id_comprobante','id_comprobante');
    }
    public function certificadosDepositoComprobante()
    {
        return $this->hasMany('App\Models\CertificadoDepositoComprobante','id_comprobante','id_comprobante');
    }
    public function parciales()
    {
        return $this->hasMany('App\Models\Parcial','id_comprobante','id_comprobante');
    }
    /* sin datos */
    public function retenciones()
    {
        return $this->hasMany('App\Models\Retencion','id_comprobante','id_comprobante');
    }

    public function percepciones()
    {
        return $this->hasMany('App\Models\Percepcion','id_comprobante','id_comprobante');
    }
                    
    /*filtros*/
    
    public function scopeEmisor ($query, $cuit) {
	    return $query->whereHas('emisor', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}

	public function scopeDestinatario ($query, $cuit) {
	    return $query->whereHas('destinatario', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}



}

