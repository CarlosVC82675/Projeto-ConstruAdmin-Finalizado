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
        Schema::table('usuarios', function (Blueprint $table) {

                //Chave estrangeira
                $table->unsignedBigInteger('Lista_Atividades_Atividade_Obras_IdObras');
                $table->foreign('Lista_Atividades_Atividade_Obras_IdObras')->references('Atividade_Obras_idObras')->on('lista_atividades');

                 //Chave estrangeira
                $table->unsignedBigInteger('Lista_Atividades_Atividade_idAtividade');
                $table->foreign('Lista_Atividades_Atividade_idAtividade')->references('Atividade_idAtividade')->on('lista_atividades');

                 //Chave estrangeira
                $table->unsignedBigInteger('Estoque_idEstoque');
                $table->foreign('Estoque_idEstoque')->references('idEstoque')->on('estoque');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adicionar_atributos_tabela_usuario');
    }
};
