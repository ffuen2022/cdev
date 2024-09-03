<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdrProducto extends Model
{
    use HasFactory;
    protected $fillable = ['sdr_dao_id', 'item', 'descripcion', 'unidad_medida', 'cantidad'];

    
    
public function sdrDao(){
    
    return $this->belongsTo(SdrDao::class);
}

}
