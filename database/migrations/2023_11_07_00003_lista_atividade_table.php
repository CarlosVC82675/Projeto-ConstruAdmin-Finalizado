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
        Schema::create('lista_atividade', function (Blueprint $table) {

//ERRO: Comentario com Linguagem irregular
//own_atributtes is not necessary, considere use withpivot instead




//foreing_key
$table->unsignedBigInteger('Atividade_idAtividade');

$table->unsignedBigInteger('Atividade_Obras_idObras');


//Foreing_key_set
$table->foreign('atividade_idAtividade')->references('idAtividade')->on('atividade');
$table->foreign('Atividade_Obras_idObras')->references('idObras')->on('obras');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_atividade');
    }
};
