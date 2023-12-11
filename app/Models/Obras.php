<?php
// Diego Oliveira
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obras extends Model
{
    use HasFactory;
    protected $fillable = ['nome','status','descricao','tamanho','tipo','logradouro','numResidencial','bairro','cidade','estado','cep','estrutura','proposito','dtFinal','dtInicial'];
    protected $table = "obras";
    protected $primaryKey = "idObras";


    public function usuarios(){
        return $this->belongsToMany(Usuario::class, 'lista_obras', 'Obras_idObras', 'Usuario_idUsuario');
    }

    public function atividades(){
        return $this->hasMany(Atividades::class, 'Obras_idObras', 'idObras');
    }

    public function materiais(){
        return $this->belongsToMany(Materiais_Estoque::class, 'lista_materiais_necessarios', 'Obras_idObras', 'Materiais_idMateriais')
            ->withPivot('quantidade'); // Obtém o atributo 'quantidade' da tabela intermediária
    }


    public function arquivo(){
        return $this->hasMany(Arquivo::class);
    }
}
