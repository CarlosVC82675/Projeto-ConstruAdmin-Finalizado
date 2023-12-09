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
        'responsavel',
        'Obras_idObras',
    ];

    public function obra()
    {
        return $this->belongsTo(Obras::class, 'Obras_idObras');
    }

    public function usuarios()
    {
        return $this->belongsToMany(usuario::class, 'lista_Atividades', 'Atividade_idAtividade', 'Usuarios_idUsuario');
    }
}
