<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fotos extends Model
{
    use HasFactory;
    protected $table = "fotos";
    protected $primaryKey = "idFoto";


    public function projetos(){
        return $this->belongsTo(Projetos::class,'idProjeto');
    }

}
