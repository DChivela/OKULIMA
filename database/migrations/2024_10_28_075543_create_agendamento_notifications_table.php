<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verifica se as tabelas `agendamentos` e `users` existem antes de criar a tabela de notificações
        if (Schema::hasTable('agendamentos') && Schema::hasTable('users')) {
            Schema::create('agendamento_notifications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('agendamento_id');
                $table->unsignedBigInteger('user_id');
                $table->string('title');
                $table->text('message');
                $table->boolean('read')->default(false);
                $table->string('type')->default('agendamento');
                $table->timestamps();

                // Chaves estrangeiras com CASCADE e indexação para melhor performance
                $table->foreign('agendamento_id')
                      ->references('id')
                      ->on('agendamentos')
                      ->onDelete('cascade')
                      ->onUpdate('cascade'); // Adiciona CASCADE em updates

                $table->foreign('user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');

                $table->index(['agendamento_id', 'user_id']); // Indexa as chaves estrangeiras
            });
        } else {
            throw new \Exception("As tabelas `agendamentos` e `users` devem existir antes de executar esta migração.");
        }
    }

    public function down()
    {
        Schema::dropIfExists('agendamento_notifications');
    }
};
