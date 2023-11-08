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
        Schema::create('obras_projetos', function (Blueprint $table) {

            $table->unsignedBigInteger('id_obras');
            $table->foreign('id_obras')->references('idObras')->on('obras')->onDelete('cascade')->onUpdate('cascade');;

            //ERRO: referencia errada
            $table->unsignedBigInteger('id_projetos');
            $table->foreign('id_projetos')->references('idprojecao')->on('projetos');

            $table->char('titulo',80);

           //ERRO: file nao funciona
           //$table->file('arquivo');
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
