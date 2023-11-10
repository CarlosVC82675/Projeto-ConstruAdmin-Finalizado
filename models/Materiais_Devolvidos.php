<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais_Devolvidos extends Model
{
    use HasFactory;

    public function estoque(){
        return $this->belongsTo(estoque::class);
    }

    public function materiais(){
        return $this->hasMany(materiais::class);
    }
}
