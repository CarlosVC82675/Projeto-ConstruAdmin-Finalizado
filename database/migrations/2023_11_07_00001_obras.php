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
            //Erro ID nao nomeada
            $table->id('idObras');
            $table->char('nome',100);
            $table->enum('status',['COMEÇANDO','ANDAMENTO','FINALIZADO']);
            $table->string('descricao');
            $table->decimal('tamanho');
            $table->enum('tipo',['RESIDENCIAL','COMERCIAL','INDUSTRIAL','INFRAESTRUTURA','SANEAMENTO','RESTAURO']);
            $table->string('descriçãoObra');
            $table->char('logradouro',100);
            $table->char('numResidencial',100);
            $table->char('bairro',100);
            $table->char('cidade',80);
            $table->char('estado',80);
            $table->char('cep',8);
            $table->enum('estrutura',['METALICA','CONCRETO','MADEIRA']);
            $table->string('proposito');
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
