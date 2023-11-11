<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public function telefones(){

        return $this->hasMany(TelefoneUsuario::class,'Usuarios_idUsuario','idUsuario');

    }

    public function atribuição(){
        return $this->belongsTo(Atribuicao_Usuario::class,'atribuicao_idAtribuicao','id_atribuicao');
    }

    public function estoque(){

        return $this->belongsTo(Estoque::class,'Estoque_idEstoque','idEstoque');

    }

    public function obras(){

        return $this->belongsToMany(Obras::class,'lista_obras','Usuarios_idUsuario','Obras_idObras');
    }

    public function atividades(){

        return $this->belongsToMany(Atividades::class,'lista_Atividades','Usuarios_idUsuario','Atividade_idAtividade');
    }


}
