<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;
    
    protected $fillable = ['sdr_dao_id','numero_certificado', 'archivo', 'fecha_emision'];

    public function sdrDao()
    {
        return $this->belongsTo(SdrDao::class);
    }
}
