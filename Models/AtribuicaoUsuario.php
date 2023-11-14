<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtribuicaoUsuario extends Model
{
    use HasFactory;

    //tabela que faz parte
    protected $table = 'atribuicao_usuario';

    //Chave primaria
    protected $primaryKey = 'id_atribuicao';



     public function usuarios(){
       return $this->hasMany(Usuario::class,'atribuicao_idAtribuicao','id_atribuicao');
     }

}
