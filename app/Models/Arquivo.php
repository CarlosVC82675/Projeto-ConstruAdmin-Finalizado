<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arquivo extends Model
{
    use HasFactory;
    protected $fillable = ['caminho','Obras_IdObras','nome','extensao','tipo'];
    protected $table = "arquivo";
    protected $primaryKey = "idArquivo";

    public function obras(){
        return $this->belongsTo(Obras::class,'idProjeto');
    }
}
