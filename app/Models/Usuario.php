<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //tabela que faz parte
    protected $table = 'usuarios';

    //Chave primaria
    protected $primaryKey = 'idUsuario';


    //Metodo Fillable
    protected $fillable = [
        'atribuicao_Usuario_id_Atribuicao',
        'Estoque_idEstoque',
        'Superior_idUsuario',
        'password',
        'name',
        'lastName',
        'genero',
        'cep',
        'cpf',
        'pais',
        'cidade',
        'estado',
        'email',
    ];


    //Relacionamentos
    public function telefones(){

        return $this->hasMany(TelefoneUsuario::class,'Usuarios_idUsuario','idUsuario');

    }

    public function atribuição(){

        return $this->belongsTo(AtribuicaoUsuario::class,'atribuicao_Usuario_id_Atribuicao','id_atribuicao');
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class,'Estoque_idEstoque','idEstoque');
    }

    public function obras(){
        return $this->belongsToMany(Obras::class, 'lista_obras', 'Usuario_idUsuario', 'Obras_idObras');
    }

    public function atividades(){
        return $this->belongsToMany(Atividades::class,'lista_Atividades','Usuarios_idUsuario','Atividade_idAtividade');
    }


}
