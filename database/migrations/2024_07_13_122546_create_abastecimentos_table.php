<?php

// database/migrations/xxxx_xx_xx_create_abastecimentos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbastecimentosTable extends Migration
{
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipamento_id');
            $table->string('produto');
            $table->decimal('quantidade', 8, 2);
            $table->decimal('preco_unitario', 8, 2);
            $table->timestamp('data_abastecimento');
            $table->timestamps();

            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('abastecimentos');
    }
}
