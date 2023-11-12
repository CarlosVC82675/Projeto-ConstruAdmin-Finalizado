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
        Schema::create('projeto', function (Blueprint $table) {

            $table->id('idProjeto');
          
            
            $table->unsignedBigInteger('Obras_idObras');
            $table->foreign('Obras_idObras')->references('idObras')->on('obras')->onDelete('cascade')->onUpdate('cascade');
           

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
