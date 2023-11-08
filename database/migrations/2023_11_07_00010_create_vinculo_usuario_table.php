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
        Schema::create('vinculo_usuario', function (Blueprint $table) {
            $table->id('idVinculoUsuario');

            //Chave estrangeira
            $table->unsignedBigInteger('Usuarios_idUsuario');
            $table->foreign('Usuarios_idUsuario')->references('idUsuario')->on('usuarios');

            $table->text('vinculo')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vinculo_usuario');
    }
};
