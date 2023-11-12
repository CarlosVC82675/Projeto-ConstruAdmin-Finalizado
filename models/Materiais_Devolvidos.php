<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais_Devolvidos extends Model
{
    use HasFactory;

    protected $table = 'materiais_devolvidos';
    protected $primaryKey = 'idEntrada_Devolu';

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }

    public function materiais(){
        return $this->hasMany(Material::class);
    }
}
