<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario');

             //auto Relacionamento
            $table->unsignedBigInteger('Superior_idUsuario')->nullable();
            $table->foreign('Superior_idUsuario')->references('idUsuario')->on('usuarios');

            $table->string('password');
            $table->string('name')->nullable(false);
            $table->string('lastName')->nullable();
            $table->enum('genero',['FEMININO','MASCULINO'])->nullable(false);
            $table->char('cep',8)->nullable(false);
            $table->char('cpf',11)->unique()->nullable(false);
            $table->string('pais')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('email')->unique()->nullable(false);
            $table->enum('atribuição',['USUARIO_COMUM','EMPRESA','SUPEVISOR','APONTADOR'])->nullable(false);
            $table->rememberToken();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
