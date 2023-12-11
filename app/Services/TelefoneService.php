<?php

namespace App\Services;

use App\Models\TelefoneUsuario;


class TelefoneService
{

public function CriarTelefones($usuario, $dados)
{
        $telefones = [];

        for ($i = 1; $i <= 3; $i++) {
            $telefone = $dados->input('telefone' . $i);
            if ($telefone) {
                $telefones[] = $telefone;
            }
        }

        foreach ($telefones as $telefone) {
            TelefoneUsuario::create([
            'telefone' => $telefone,
            'Usuarios_idUsuario' => $usuario->idUsuario,
            ]);
        }
}

public function AtualizarTelefones($usuario, $dados)
{

    $telefones = [];

    for ($i = 1; $i <= 3; $i++) {
        $telefone = $dados->input('telefone' . $i);
        if ($telefone) {
            $telefones[] = $telefone;
        }
    }

        TelefoneUsuario::where('Usuarios_idUsuario', $usuario->idUsuario)->delete();


            foreach ($telefones as $telefone) {
                TelefoneUsuario::create([
                'telefone' => $telefone,
                'Usuarios_idUsuario' => $usuario->idUsuario,
                ]);
            }
}




}
