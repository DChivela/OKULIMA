<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabalhadoresTable extends Migration
{
    public function up()
    {
        Schema::create('trabalhadores', function (Blueprint $table) {
            $table->id();
            $table->string('numero_profissao');
            $table->string('nome_profissao');
            $table->decimal('custo_trabalho', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trabalhadores');
    }
}
