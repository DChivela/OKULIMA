<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeColheitasTable extends Migration
{
    public function up()
    {
        Schema::create('atividade_colheitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->foreignId('fazenda_id')->constrained('fazendas')->onDelete('cascade');
            $table->foreignId('campo_cultivo_id')->constrained('campos_cultivo')->onDelete('cascade');
            $table->date('data');
            $table->time('hora_inicial');
            $table->time('hora_final');
            $table->integer('duracao');
            $table->decimal('custo_unitario', 10, 2);
            $table->decimal('valor_colheita', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atividade_colheitas');
    }
}
