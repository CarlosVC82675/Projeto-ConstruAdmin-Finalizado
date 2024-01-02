<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
       // Criar permissões
        $Permissions = [
        'Usuario',
        'Estoque',
        'Obrafora',
        'Projeto',
        'DownloadProjeto',
        'Materiais',
        'Atividade',
        'relatorioGeral',
        'relatorioMaterial',
        'relatorioObra'
        ];




        foreach ($Permissions as $Permission) {
            Permission::firstOrCreate(['name' => $Permission]);
        }

        $Acesso = [
        'Administrador',
        'Supervisor',
        'Apontador',
        'Engenheiro',
        'Cliente',
        'Comum'
        ];


        foreach ($Acesso as $roles) {
            Role::firstOrCreate(['name' => $roles]);
        }

        // Buscando os papeis
        $roleAdm = Role::findByName('Administrador');
        $roleSupevisor = Role::findByName('Supervisor');
        $roleApontador = Role::findByName('Apontador');
        $roleEngenheiro = Role::findByName('Engenheiro');
        $roleCliente = Role::findByName('Cliente');
        $roleComum = Role::findByName('Comum');

        //Buscando permissões
        $permissoesAdmin = Permission::whereIn('name', $Permissions)->get();

        //Atribuindo permissões
        $roleAdm->syncPermissions($permissoesAdmin);
        $roleSupevisor->syncPermissions('Projeto','DownloadProjeto','Materiais','Atividade','relatorioMaterial','relatorioObra');
        $roleApontador->syncPermissions('Estoque','Materiais','DownloadProjeto','relatorioMaterial');
        $roleEngenheiro->syncPermissions('Projeto','DownloadProjeto','Atividade','relatorioObra');
        $roleCliente->syncPermissions('DownloadProjeto','relatorioMaterial','relatorioObra');
        $roleComum->syncPermissions('DownloadProjeto');
    }

}
