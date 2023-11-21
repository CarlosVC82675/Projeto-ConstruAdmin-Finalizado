<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id('idEstoque');
            $table->unsignedBigInteger('Entrada_Devolu_Materiais_idMateriais');
            $table->string('nomeEstoque', 100)->nullable(false);
            $table->timestamps();
            $table->foreign('Entrada_Devolu_Materiais_idMateriais')->references('Materiais_idMateriais')->on('entrada_devolu')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};
