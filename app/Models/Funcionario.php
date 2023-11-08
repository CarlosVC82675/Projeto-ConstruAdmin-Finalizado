<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    //Funcionario pode ter varios empregados
    public function Empregados(){

        return $this->hasMany(Funcionario::class,'id_gerente');
    }

    //Funcionario pode ter um gerente
    public function Gerente(){
        return $this->belongsTo(Funcionario::class,'id_gerente');
    }

    //funcionario pode ter varias obras
    public function Obras()
    {
        return $this->belongsToMany(Obras::class,'funcionario_obras', 'funcionarios_id', 'obra_id');
    }


}
