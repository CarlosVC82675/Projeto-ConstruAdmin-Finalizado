<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Facade\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

       Schema::create('lista_materiais_necessarios', function (Blueprint $table) {


//atributes to foreing key

$table->unsignedBigInteger('Obras_idObras');
$table->unsignedBigInteger('Materiais_idMateriais');

//foreing key set

$table->foreign('Obras_idObras')->references('idObras')->on('obras')->onDelete('cascade');
$table->foreign('Materiais_idMateriais')->references('idMateriais')->on('materiais_estoque');

$table->timestamps();


    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_materiais_necessarios');
    }
};
