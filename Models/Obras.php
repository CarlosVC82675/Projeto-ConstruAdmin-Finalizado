<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obras extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];
    protected $table = "obras";
    protected $primaryKey = "idObras";


    public function usuarios(){
        return $this->belongsToMany(Usuarios::class,'lista_obras','Obras_idObras','idUsuario');
    }

    public function atividade(){
        return $this->hasMany(Atividade::class,'Obras_idObras','idAtividade');
    }

    public function materiais(){
        return $this->belongsToMany(Materiais_Estoque::class,'lista_materias_necessarios','Obras_idObras','Materiais_idMaterias');
    }

    public function arquivo(){
        return $this->hasMany(Arquivo::class);
    }
}
