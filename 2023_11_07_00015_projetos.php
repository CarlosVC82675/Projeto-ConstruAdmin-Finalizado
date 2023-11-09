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
        Schema::create('projetos', function (Blueprint $table) {
          
            
            $table->unsignedBigInteger('obras_id_obras');
            $table->unsignedBigInteger('id_fotos');
            $table->unsignedBigInteger('id_2d3d');

            $table->primary(['obras_id_obras', 'id_fotos','id_2d3d']);
           
            $table->foreign('obras_id_obras')->references('idObras')->on('obras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fotos')->references('idfoto')->on('fotos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_2d3d')->references('id2d3d')->on('2d3d')->onDelete('cascade')->onUpdate('cascade');


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
