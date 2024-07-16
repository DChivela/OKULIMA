<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamposCultivoTable extends Migration
{
    public function up()
    {
        Schema::create('campos_cultivo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fazenda_id');
            $table->string('numero_campo');
            $table->string('nome_campo');
            $table->decimal('area_campo', 8, 2);
            $table->date('data_exploracao');
            $table->string('sistema_irrigacao');
            $table->timestamps();

            $table->foreign('fazenda_id')->references('id')->on('fazendas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('campos_cultivo');
    }
}
