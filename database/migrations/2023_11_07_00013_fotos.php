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
        Schema::create('fotos', function (Blueprint $table) {
           //ERRO: ID nao nomeada
            $table->id('idfoto');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
