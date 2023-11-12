<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obras extends Model
{
    use HasFactory;
    protected $table = "obras";
    protected $primaryKey = "idObras";


    public function usuario(){
        return $this->belongsToMany(Usuarios::class,'lista_obras','Obras_idObras','idUsuario');
    }

    public function atividades(){
        return $this->hasMany(Atividade::class,'Obras_idObras','idAtividade');
    }

    public function materiais(){
        return $this->belongsToMany(Materiais::class,'lista_materias_necessarios','Obras_idObras','Materiais_idMaterias');
    }

    public function projeto(){
        return $this->hasOne(Projetos::class);
    }
}
