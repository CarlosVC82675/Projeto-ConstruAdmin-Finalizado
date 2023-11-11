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
        Schema::create('lista_obras', function (Blueprint $table) {

            //Chave estrangeira de obras
            $table->unsignedBigInteger('Obras_idObras');

            //Chave estrangeira de usuarios
            $table->unsignedBigInteger('Usuario_idUsuario');

            $table->foreign('Obras_idObras')->references('idObras')->on('obras');
            $table->foreign('Usuario_idUsuario')->references('idUsuario')->on('usuarios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_obras');
    }
};
