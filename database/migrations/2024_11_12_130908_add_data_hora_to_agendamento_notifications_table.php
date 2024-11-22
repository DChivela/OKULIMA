<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('agendamento_notifications', function (Blueprint $table) {
        $table->datetime('data_hora')->nullable(); // Adiciona o campo 'data_hora' do tipo datetime, que pode ser nulo
    });
}

public function down()
{
    Schema::table('agendamento_notifications', function (Blueprint $table) {
        $table->dropColumn('data_hora'); // Remove o campo se a migration for revertida
    });
}
};
