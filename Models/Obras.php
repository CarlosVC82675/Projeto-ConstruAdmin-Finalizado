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
        return $this->belongsToMany(Usuarios::class,'lista_obras','obras_id_obras','idUsuario');
    }

    public function atividades(){
        return $this->hasMany(Atividades::class,'obras_id_obras','idAtividade');
    }

    public function materiais(){
        return $this->belongsToMany(Materiais::class,'lista_materias_necessarios','obras_id_obras','materiais_idmaterias');
    }

    public function projetos(){
        return $this->hasOne(Projetos::class);
    }
}
