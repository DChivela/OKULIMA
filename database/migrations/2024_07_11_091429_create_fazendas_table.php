<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFazendasTable extends Migration
{
    public function up()
    {
        Schema::create('fazendas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_fazenda');
            $table->string('nome_fazenda');
            $table->decimal('area_fazenda', 8, 2);
            $table->date('data_aquisicao');
            $table->date('data_exploracao');
            $table->unsignedBigInteger('pais_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('municipio_id');
            $table->boolean('rios');
            $table->decimal('extensao_rios', 8, 2)->nullable();
            $table->boolean('furos');
            $table->integer('qtd_furos')->nullable();
            $table->string('numero_matriz');
            $table->decimal('valor_predial', 8, 2);
            $table->timestamps();

            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('cascade');
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fazendas');
    }
}
