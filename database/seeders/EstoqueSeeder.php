<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estoque;

class EstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dadosEstoque = [
        'nomeEstoque' =>'Estoque'
        ];

        estoque::create($dadosEstoque);
    }
}
