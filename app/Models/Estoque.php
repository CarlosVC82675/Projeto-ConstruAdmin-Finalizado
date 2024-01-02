<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';
    protected $primaryKey = 'idEstoque';

    public function usuario(){
        return $this->hasMany(Usuario::class);
    }

    public function materiaisEstoque(){
        return $this->hasMany(Materiais_Estoque::class);
    }
}
