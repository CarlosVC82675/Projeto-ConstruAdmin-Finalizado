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


//foreing_key
$table->unsignedBigInteger('Atividade_idAtividade');


$table->unsignedBigInteger('Usuarios_idUsuario');


//Foreing_key_set
$table->foreign('atividade_idAtividade')->references('idAtividade')->on('atividade');

$table->foreign('Usuarios_idUsuario')->references('idUsuario')->on('usuarios');


$table->primary(['Atividade_idAtividade','Usuarios_idUsuario']);
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
