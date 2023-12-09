<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id('idObras');
            $table->string('nome',50);
            $table->enum('status',['Andamento','Finalizado']);
            $table->string('descricao');
            $table->string('tamanho');
            $table->enum('tipo',['Residencial','Comercial','Industrial','Infraestrutura','Saneamento','Restauro']);
            $table->string('logradouro',100);
            $table->string('numResidencial',100);
            $table->string('bairro',100);
            $table->string('cidade',80);
            $table->string('estado',80);
            $table->string('cep',9);
            $table->enum('estrutura',['Metálica','Concreto','Madeira']);
            $table->string('proposito');
            $table->date('dtFinal')->nullable(true);
            $table->date('dtInicial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
