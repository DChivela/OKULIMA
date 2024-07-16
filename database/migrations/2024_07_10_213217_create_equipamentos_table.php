<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentosTable extends Migration
{
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_equipamento');
            $table->string('nome_equipamento');
            $table->date('data_aquisicao');
            $table->decimal('valor_aquisicao', 10, 2);
            $table->decimal('vida_util', 10, 2);
            $table->decimal('custo_hora', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipamentos');
    }
}
