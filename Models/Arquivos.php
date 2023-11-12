<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arquivo extends Model
{
    use HasFactory;
    protected $table = "arquivos";
    protected $primaryKey = "idArquivo";

    public function projeto(){
        return $this->belongsTo(Projetos::class,'idProjeto');
    }
}
