<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Scalar\String_;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atividade', function (Blueprint $table) {
            //BEGIN ATRI
           $table->id('idAtividade');
          $table->String('nome')->nullable(false);
          $table->String('etiqueta')->nullable(true);
           $table->String('anexo')->nullable(true);
           $table->longText('descrição')->nullable(true); 
           $table->Date('dtFinal')->nullable(false) ;
           $table->Date('dtInicial') ->nullable(false);
           $table->enum( 'status',['COMEÇANDO','ANDAMENTO','FINALIZADO'])->default ('COMEÇANDO'); 
          $table->String('responsavel')->nullable(false) ;   
          //END ATRI

//BEGIN FK
          $table->unsignedBigInteger('Obras_idObras');

          $table->foreign('Obras_idObras')->references('idObras')->on('obras');
// END FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atividade');
    }
};
