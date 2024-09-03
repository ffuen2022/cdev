<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = ['sdr_dao_id', 'archivo'];

    public function sdrDao()
    {
        return $this->belongsTo(SdrDao::class);
    }

}
