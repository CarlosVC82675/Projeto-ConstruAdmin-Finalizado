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
        Schema::create('atribuicao_usuario', function (Blueprint $table) {
            $table->id('id_atribuicao');
            $table->enum('atribuição',['COMUM','EMPRESA','SUPEVISOR','APONTADOR','ENGENHEIRO'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atribuicao_usuario');
    }
};
