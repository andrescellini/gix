<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
    protected $table = 'descargas';
    protected $primaryKey = 'id_descarga';

    protected $appends = ['datosAuxiliares'];

    protected $dates = [
        'fecha_carga',
        'fecha_vencimiento',
        'fecha_confirmacion_ctg',
        'fecha_descarga',
    ];   
    
    protected $casts = [
        'carta_porte' => 'integer',
        'numero_cee' => 'integer',
        'numero_ctg' => 'integer',
        'kilos_tara_origen' => 'integer',
        'kilos_neto_origen' => 'integer',
        'kilos_tara_destino' => 'integer',
        'kilos_neto_destino' => 'integer',
        'kilos_merma_humedad' => 'integer',
        'kilos_merma_calidad' => 'integer',
        'kilos_merma_volatil' => 'integer',
        'kilos_merma_zaranda' => 'integer',
        'kilos_finales_descarga' => 'integer',
        'kilos_confirmados_definitivos_ctg' => 'integer',
        'kilos_brutos_origen' => 'integer',
    ];

    /*getters setters*/
    
    public function getDatosAuxiliaresAttribute(){
    	return [];
    }
    
 

    /*relaciones*/

    public function titular(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_titular');
    }
    public function intermediario(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_intermediario');
    }
    public function remitenteComercial(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_remitente_comercial');
    }
    public function corredorComprador(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_corredor_comprador');
    }
    public function corredorVendedor(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_corredor_vendedor');
    }
    public function mercadoaTermino(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_mercado_a_termino');
    }
    public function intermediarioFlete(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_flete');
    }
    public function entregador(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_entregador');
    }
    public function destinatario(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_destinatario');
    }
    public function destino(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_destino');
    }
    public function transportista(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_transportista');
    }
    public function chofer(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_chofer');
    }
    public function vendedor(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_vendedor');
    }
    public function comprador(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_comprador');
    }
    public function vendedorTermino(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_vendedor_termino');
    }
    public function compradortermino(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_comprador_termino');
    }
    public function corredorTermino(){
        return $this->hasOne('App\Models\Interviniente','id_interviniente','id_interviniente_corredor_termino');
    }


    public function localidadComprador()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_comprador');
    }

    public function localidadVendedor()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_vendedor');
    }    
    
    public function procedencia()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_procedencia');
    }   

    public function lugarDestino()
    {
        return $this->hasOne('App\Models\Localidad','id_localidad','id_localidad_destino');
    }   

    public function producto()
    {
        return $this->hasOne('App\Models\Producto','id_producto','id_producto');
    }   

    public function transporte()
    {
        return $this->hasOne('App\Models\Transporte','id_transporte','id_transporte');
    }   


    public function servicios()
    {
        return $this->hasMany('App\Models\Servicio','id_descarga','id_descarga');
    }

    public function biotecnologias()
    {
        return $this->hasMany('App\Models\Biotecnologia','id_descarga','id_descarga');
    }

    public function ensayosDescargas()
    {
        return $this->hasMany('App\Models\EnsayoDescarga','id_descarga','id_descarga');
    }


    
    /*filtros*/
    
    
    public function scopeCorredorComprador ($query, $cuit) {
	    return $query->whereHas('corredorComprador', function ($q) use ($cuit) {
	            $q->where('cuit', $cuit);
	    });
	}

    public function scopeCorredorVendedor ($query, $cuit) {
        return $query->whereHas('corredorVendedor', function ($q) use ($cuit) {
                $q->where('cuit', $cuit);
        });
    }

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

	public function scopeProducto ($query, $codigo_producto) {
	    return $query->whereHas('producto', function ($q) use ($codigo_producto) {
	            $q->where('codigo_producto', $codigo_producto);
	    });
	}

     
}

