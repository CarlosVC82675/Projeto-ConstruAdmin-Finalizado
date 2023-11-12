<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projetos extends Model
{
    use HasFactory;
    protected $table = "projeto";
    protected $primaryKey = "idProjeto";


    public function obras(){
        return $this->belongsTo(Obras::class,'idObras');
    }

    public function arquivos(){
        return $this->hasMany(Arquivos::class,'Projeto_idProjeto','idArquivo');
    }

    public function fotos(){
        return $this->hasMany(Fotos::class,'Projeto_idProjeto','idFoto');
    }
}
