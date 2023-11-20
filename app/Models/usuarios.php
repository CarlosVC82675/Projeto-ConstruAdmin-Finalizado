<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    protected $fillable = [
        'nome',
    ];
    public function atividades()
    {
        return $this->belongsToMany(Atividades::class, 'lista_Atividades', 'Usuarios_idUsuario', 'Atividade_idAtividade');
    }
}




