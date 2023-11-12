<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais extends Model
{
    use HasFactory;

    protected $table = 'materiais';
    protected $primaryKey = 'idMateriais';

    public function materiaisDevolvidos(){
        return $this->belongsTo(MaterialDevolvido::class);
    }

    public function obras(){
        return $this->belongsToMany(Obra::class, 'lista_materiais_necessarios', 'id_materiais', 'id_obras');
    }
    
    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
