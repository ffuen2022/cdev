<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdrDao extends Model
{
    use HasFactory;

    protected $fillable = ['id',
        'fecha', 'solicitado_por','unidad', 'fecha_unidad',
        'cuenta_presupuestaria', 'folio_sdr', 'id_materiales', 
        'justificacion_del_requerimiento'
    ];

    public function sdrproductos()
    {
        return $this->hasMany(SdrProducto::class ,'sdr_dao_id');
    }

    public function matHerVei()
    {
        return $this->belongsTo(MatHerVei::class, 'id_materiales');
    }

    public function cotizacions()
    {
        return $this->hasMany(Cotizacion::class, 'sdr_dao_id');
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'sdr_dao_id');
    }

    public function consolidado()
    {
        return $this->hasMany(Consolidado::class,'sdr_dao_id');
    }

    public function solicitud()
    {
        return $this->hasMany(SolicitudPedido::class,'sdr_dao_id');
    }

    public function ordencompra()
    {
        return $this->hasMany(OrdenCompra::class,'sdr_dao_id');
    }

    public function recepciones()
    {
        return $this->hasMany(Recepcion::class,'sdr_dao_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class,'sdr_dao_id');
    }

}
