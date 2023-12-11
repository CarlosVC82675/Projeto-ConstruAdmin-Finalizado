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
    Schema::create("Comentarios", function (Blueprint $table) {
$table->id('idComentarios');
$table->text('comentario');
$table->timestamps();



$table->unsignedBigInteger('Usuarios_idUsuario');
$table->unsignedBigInteger('Atividade_idAtividade');



$table->foreign('Usuarios_idUsuario')->references('idUsuario')->on('usuarios')->onDelete('cascade');
$table->foreign('Atividade_idAtividade')->references('idAtividade')->on('atividade')->onDelete('cascade');



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
