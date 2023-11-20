<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    use HasFactory;
    protected $table = 'obras';
    protected $primaryKey = 'idObra';
    public function Atividades(){


        $this->belongsTo(Atividades::class,'obra_FK','idAtividade');
    }
}
