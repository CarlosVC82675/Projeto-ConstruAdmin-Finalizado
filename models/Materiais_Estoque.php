<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais_Estoque extends Model
{
    use HasFactory;

    protected $table = 'materiais';
    protected $primaryKey = 'idMateriais';


    public function listaMateriaisNecessarios(){
        return $this->belongsToMany(ListaMaterialNecessario::class)->withPivot('quantidade');
    }
    
    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
