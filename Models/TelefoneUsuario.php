<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefoneUsuario extends Model
{
    use HasFactory;


    //tabela que faz parte
    protected $table = 'telefone_usuarios';



    protected $fillable = [
        'telefone',
        'Usuarios_idUsuario',

    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class,'Usuarios_idUsuario','idUsuario');
    }
}
