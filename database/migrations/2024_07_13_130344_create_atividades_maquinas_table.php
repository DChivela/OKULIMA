<?php

// database/migrations/xxxx_xx_xx_create_atividades_maquinas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesMaquinasTable extends Migration
{
    public function up()
    {
        Schema::create('atividades_maquinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipamentos_id');
            $table->unsignedBigInteger('fazendas_id');
            $table->unsignedBigInteger('campos_cultivo_id');
            $table->date('data_atividade');
            $table->time('hora_inicial');
            $table->time('hora_final');
            $table->integer('duracao'); // duração em minutos
            $table->decimal('custo_unitario', 8, 2);
            $table->decimal('valor_trabalho', 8, 2);
            $table->timestamps();

            $table->foreign('equipamentos_id')->references('id')->on('equipamentos');
            $table->foreign('fazendas_id')->references('id')->on('fazendas');
            $table->foreign('campos_cultivo_id')->references('id')->on('campos_cultivo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('atividades_maquinas');
    }
}
