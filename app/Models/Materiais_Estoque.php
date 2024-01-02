<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais_Estoque extends Model
{
    use HasFactory;

    protected $table = 'materiais_estoque';
    protected $primaryKey = 'idMateriais';

    protected $fillable = [
        'Estoque_idEstoque',
        'kg',
        'nomeM',
        'metros',
        'quantidade',
        'dtVencimento',
        'dtEntrada',
        'dtSaida',
        'Status_2',
    ];


    public function obras(){
        return $this->belongsToMany(Obras::class, 'lista_materiais_necessarios', 'Materiais_idMateriais', 'Obras_idObras')
            ->withPivot('quantidade'); // Obtém o atributo 'quantidade' da tabela intermediária
    }


    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
