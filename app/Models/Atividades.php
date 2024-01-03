<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividades extends Model
{
    use HasFactory;

    protected $table = 'atividade';
    protected $primaryKey = 'idAtividade';
    protected $fillable = [
        'nome',
        'etiqueta',
        'anexo',
        'descricao',
        'dtFinal',
        'dtInicial',
        'status',
        'card_atividades_idCard',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'lista_atividade', 'Atividade_idAtividade', 'Usuarios_idUsuario');
    }

    public function card()
    {
        return $this->belongsTo(card_atividades::class,'card_atividades_idCard','idCard');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class,'idComentarios');
    }
}
