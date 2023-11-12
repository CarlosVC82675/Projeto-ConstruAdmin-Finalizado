<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';
    protected $primaryKey = 'idEstoque';

    public function materiaisDevolvidos(){
        return $this->hasOne(MaterialDevolvido::class);
    }

    public function usuario(){
        return $this->hasMany(Usuario::class);
    }

    public function materiais(){
        return $this->hasOne(Material::class);
    }
}
