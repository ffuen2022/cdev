<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPedido extends Model
{
    use HasFactory;
    
    protected $fillable = ['sdr_dao_id','numero_solicitud', 'archivo', 'fecha_emision'];

    public function sdrDao()
    {
        return $this->belongsTo(SdrDao::class);
    }
}
