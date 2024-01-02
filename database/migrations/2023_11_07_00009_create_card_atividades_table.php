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
        Schema::create('card_atividades', function (Blueprint $table) {
            $table->id('idCard');
            $table->string('titulo');
            $table->unsignedBigInteger('Obras_idObras');
            $table->foreign('Obras_idObras')->references('idObras')->on('obras')->ondelete('cascade')->onupdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_atividades');
    }
};
