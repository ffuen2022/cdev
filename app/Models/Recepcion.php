<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = ['sdr_dao_id','numero_recepcion', 'archivo', 'fecha_recepcion'];

    public function sdrDao()
    {
        return $this->belongsTo(SdrDao::class);
    }
}
