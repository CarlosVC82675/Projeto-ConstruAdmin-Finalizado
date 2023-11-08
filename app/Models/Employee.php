<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function subordinates()
    {
        //define um relacionamento um-para-muitos entre os funcionários e seus subordinados.
        // Isso significa que um funcionário pode ter vários subordinados
        //tem varios
        //vai retorna os funcinarios filhos que o funcionario pai tem

        //Quando você usa o método hasMany em um modelo,
        // você está indicando que há uma relação em que um registro desse modelo
        // pode ter vários registros associados a ele em outro modelo.
         // No caso dos funcionários, um funcionário pode ter vários subordinados,
         // e o método hasMany permite acessar esses subordinados diretamente
         // a partir do modelo do funcionário.

        return $this->hasMany(Employee::class, 'manager_id');

        //a função retorna todos os Employee que têm o atual funcionário como gerente,
        //o que é determinado pela chave estrangeira
    }

     public function manager()
    {
        //Este método define o inverso do relacionamento definido em subordinates().
         //A função belongsTo estabelece um relacionamento muitos-para-um,
        // indicando que muitos funcionários podem pertencer a um único gerente.
        //pertence a um
        //vai retorna o funcinario pai que o funcionario filho pertence
        return $this->belongsTo(Employee::class, 'manager_id');

        //a função retorna o Employee que é o gerente do funcionário atual,
        //com base na chave estrangeira manager_id na tabela employees.
    }

    public function Obras()
    {
        return $this->belongsToMany(Obras::class,'lista_obras', 'employee_id', 'obra_id');
    }

}
