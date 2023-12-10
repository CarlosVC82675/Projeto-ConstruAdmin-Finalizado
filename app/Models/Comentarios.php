<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $primaryKey = 'idComentarios';
    protected $fillable = [
        'comentario',
        'Usuarios_idUsuario',
        'Atividade_idAtividade'

    ];


public function atividade(){

    return $this->belongsTo(Comentarios::class,"Atividade_idAtividade");
}
public function Usuario(){

return $this->belongsTo(Usuario::class,"Usuarios_idUsuario");


}


}
