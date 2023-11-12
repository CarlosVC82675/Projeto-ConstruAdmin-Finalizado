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
        Schema::create('arquivos', function (Blueprint $table) {
            
            $table->id('idArquivo');
            $table->unsignedBigInteger('Projeto_idProjeto');
            $table->foreign('Projeto_idProjeto')->references('idProjeto')->on('projeto')->onDelete('cascade')->onUpdate('cascade');

            $table->char('titulo',80);
            $table->string('arquivo');



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
