<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class link extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se o link simbólico já existe
        if (!file_exists(public_path('storage'))) {
            // Se não existir, executa o comando para criar o link simbólico
            Artisan::call('storage:link');
            $this->command->info('O link simbólico foi criado.');
        } else {
            $this->command->info('O link simbólico já existe.');
        }

        // Restante do código do seeder
    }
}
