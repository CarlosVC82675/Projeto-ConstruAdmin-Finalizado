<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use HasFactory;
    protected $table = "Atividade";
    protected $primaryKey = "idAtividade";

    protected $fillable = [
        'nome',
        'etiqueta',
        'anexo',
        'descrição',
        'dtFinal',
        'dtInicial',
        'status',
        'responsavel',
        'Obras_idObras',
    ];


    public function Obras(){
        return $this->belongsTo(Obras::class,'Obras_idObras','idObras');
    }
    public function Lista_Atividades(){
       return $this->belongsToMany(Usuarios::class,'Lista_Atividades','Usuarios_idUsuario','Atividade_idAtividade');
    }



}
