<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_hora');
            $table->string('local')->nullable();
            $table->foreignId('trabalhador_id')->constrained('trabalhadores')->onDelete('cascade');
            $table->foreignId('fazenda_id')->constrained('fazendas')->onDelete('cascade');
            $table->foreignId('campo_cultivo_id')->constrained('campos_cultivo')->onDelete('cascade');
            $table->text('observacao')->nullable();
            $table->timestamps();

            $table->foreign('tarefa_id')->references('id')->on('tarefas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
