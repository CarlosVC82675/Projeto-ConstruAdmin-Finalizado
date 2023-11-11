<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribuicao_Usuario extends Model
{
    use HasFactory;

     public function usuarios(){
        $this->hasmany(Usuario::class,'atribuicao_idAtribuicao','id_atribuicao');
     }

}
