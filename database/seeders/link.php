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
    
        // Executa o comando php artisan storage:link
        Artisan::call('storage:link');

        // Restante do código do seeder
    }
    }

