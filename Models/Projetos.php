<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projetos extends Model
{
    use HasFactory;
    protected $table = "projetos";
    protected $primaryKey = "idProjeto";


    public function obras(){
        return $this->belongsTo(Obras::class,'idObras');
    }

    public function arquivo(){
        return $this->hasMany(Arquivos::class,'arquivo_idaqruivo','idarquivo');
    }

    public function fotos(){
        return $this->hasMany(Fotos::class,'foto_idfoto','idfoto');
    }
}
