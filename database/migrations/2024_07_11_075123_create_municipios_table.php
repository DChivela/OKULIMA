<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
