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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id('idMateriais');
            $table->decimal('kg', 5,2)->nullable(false);
            $table->string('nomeM', 50)->nullable(false);
            $table->decimal('metros', 38,4)->nullable(false);
            $table->decimal('quantidade', 10,2)->nullable(false);
            $table->date('dtVencimento',)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais');
    }
};
