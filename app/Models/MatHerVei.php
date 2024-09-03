<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatHerVei extends Model
{
    use HasFactory;

    public function sdrDaos()
    {
        return $this->hasMany(SdrDao::class, 'id_materiales');
    }
}
