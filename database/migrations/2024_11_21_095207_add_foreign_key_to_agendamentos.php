<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ANTES DE EXECUTAR A MIGRATION DEVERÁ SE CERTICAR QUE NA TABLE AGENDAMENTOS NÃO DADOS PARA EVITAR ERRO DE INTEGRIDADE.
     * @return void
     */
    public function up()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('fazendas_id');
            $table->unsignedBigInteger('campos_cultivo_id');

            $table->foreign('fazendas_id')->references('id')->on('fazendas')->onDelete('cascade');
            $table->foreign('campos_cultivo_id')->references('id')->on('campos_cultivo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
            Schema::dropIfExists('agendamentos');
    }
};
