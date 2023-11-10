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
        Schema::create('materiais_devolvidos', function (Blueprint $table) {
            $table->id('idEntrada_Devolu');
            $table->unsignedBigInteger('Materiais_idMateriais');
            $table->unsignedBigInteger('Estoque_idEstoque');
            $table->string('nome', 50)->nullable(false);
            $table->decimal('kg', 5,2)->nullable(false);
            $table->decimal('metros', 38,4)->nullable(false);
            $table->decimal('quantidade', 10,2)->nullable(false);
            $table->date('dtVencimento')->nullable(false);
            $table->date('dtEntrada')->nullable(false);
            $table->date('dtSaida')->nullable(false);
            $table->foreign('Materiais_idMateriais')->references('idMateriais')->on('materiais')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Estoque_idEstoque')->references('idEstoque')->on('estoque')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais_devolvidos');
    }
};
