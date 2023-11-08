<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    use HasFactory;

     //indicando o nome da tabela ao qual esta relacionado
     protected $table = 'obras';

     public function Employee()
    {
        return $this->belongsToMany(Employee::class,'lista_obras', 'obra_id', 'employee_id');
    }



}
