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
            //ERRO: ID nao nomeada
            $table->id('idprojecao');
            $table->char('titulo',80);

            //referencia errada
            $table->unsignedBigInteger('id_fotos');
            $table->foreign('id_fotos')->references('idfoto')->on('fotos')->onDelete('cascade')->onUpdate('cascade');;

            //referencia errada
            $table->unsignedBigInteger('id_2d3d');
            $table->foreign('id_2d3d')->references('id2d3d')->on('2d3d')->onDelete('cascade')->onUpdate('cascade');;


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
