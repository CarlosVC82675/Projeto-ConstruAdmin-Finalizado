<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class card_atividades extends Model
{
    use HasFactory;
    protected $table = 'card_atividades';
    protected $primaryKey = 'idCard';
    protected $fillable = [
        'titulo',
        'Obras_idObras',
    ];


    public function atividade(){

        return $this->hasMany(Atividades::class, 'card_atividades_idCard');
    }
    public function obra()
    {
        return $this->belongsTo(Obras::class, 'Obras_idObras');
    }







}
