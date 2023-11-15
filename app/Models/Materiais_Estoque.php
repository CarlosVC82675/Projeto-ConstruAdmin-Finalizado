<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais_Estoque extends Model
{
    use HasFactory;

    protected $table = 'materiais_Estoque';
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

    public function listaMateriaisNecessarios(){
        return $this->belongsToMany(ListaMaterialNecessario::class)->withPivot('quantidade');
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
