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
        $PemisoesUsuario = [
        'CadastraUsuario',
        'EditiarUsuario',
        'VerificarUsuario'
        ];

        foreach ($PemisoesUsuario as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $Funções = [
        'adm',
        'Supevisor',
        ];

        foreach ($Funções as $roles) {
            Role::firstOrCreate(['name' => $roles]);
        }


        // Buscando os papeis
        $roleAdm = Role::findByName('adm');
        $roleSupevisor = Role::findByName('Supevisor');


        //Buscando permissões
        $permissoesUser = Permission::whereIn('name', $PemisoesUsuario)->get();


        //Atribuindo permissões
        $roleAdm->syncPermissions($permissoesUser);
        $roleSupevisor->syncPermissions($permissoesUser);

    }

}
