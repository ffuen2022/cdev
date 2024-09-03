<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consolidado extends Model
{
    use HasFactory;
    protected $fillable = [
        'sdr_dao_id',
        'fechaIngSp',
        'fecha_recepcion_direccion',
        'direccion',
        'descripcion',
    ];

    public function sdrDao()
    {
        return $this->belongsTo(SdrDao::class);
    }
    
}
