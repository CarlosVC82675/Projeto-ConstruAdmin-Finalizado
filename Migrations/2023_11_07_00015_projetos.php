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
        Schema::create('projetos', function (Blueprint $table) {

            $table->id('idProjeto');
          
            
            $table->unsignedBigInteger('obras_id_obras');
            $table->unsignedBigInteger('id_fotos');
            $table->unsignedBigInteger('id_arquivos');

            $table->foreign('obras_id_obras')->references('idObras')->on('obras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fotos')->references('idfoto')->on('fotos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_arquivos')->references('idArquivo')->on('arquivos')->onDelete('cascade')->onUpdate('cascade');


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
