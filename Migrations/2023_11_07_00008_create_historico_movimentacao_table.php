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
        Schema::create('historico_movimentacao', function (Blueprint $table) {
            $table->id('idLista_Movimentacao');
            $table->unsignedBigInteger('Estoque_idEstoque');
            $table->unsignedBigInteger('Materiais_idMateriais');
            $table->foreign('Estoque_idEstoque')->references('idEstoque')->on('estoque')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Materiais_idMateriais')->references('idMateriais')->on('materiais')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nomeResp', 80)->nullable(false);
            $table->date('dtSaida')->nullable(false);
            $table->date('dtEntrada')->nullable(false);
            $table->string('nomeM', 50)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_movimentacao');
    }
};
