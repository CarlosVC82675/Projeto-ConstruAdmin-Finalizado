<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Scalar\String_;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atividade', function (Blueprint $table) {
            //BEGIN ATRI
           $table->id('idAtividade');
          $table->String('nome')->nullable(false);
          $table->String('etiqueta')->nullable(true);
          $table->string('anexo')->nullable();
           $table->longText('descricao')->nullable(true); 
           $table->Date('dtFinal')->nullable(false) ;
           $table->Date('dtInicial') ->nullable(false);
           $table->enum( 'status',['COMEÇANDO','ANDAMENTO','FINALIZADO'])->default ('COMEÇANDO');  
          //END ATRI

//BEGIN FK
         
$table->unsignedBigInteger('card_atividades_idCard');


$table->foreign('card_atividades_idCard')->references('idCard')->on('card_atividades')->ondelete('cascade')->onupdate('cascade');

      
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