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
        Schema::create('entrada_devolu', function (Blueprint $table) {
            $table->id('Materiais_idMateriais');
            $table->foreign('Materiais_idMateriais')->references('idMateriais')->on('materiais')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome', 50)->nullable(false);
            $table->decimal('kg', 5,2)->nullable(false);
            $table->decimal('metros', 38,4)->nullable(false);
            $table->decimal('quantidade', 10,2)->nullable(false);
            $table->date('dtVencimento')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_entrada__devolu');
    }
};
