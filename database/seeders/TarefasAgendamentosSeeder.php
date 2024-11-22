<?php

namespace Database\Seeders;

use App\Models\Tarefa;
use App\Models\Agendamento;
use Illuminate\Database\Seeder;

class TarefasAgendamentosSeeder extends Seeder
{
    public function run()
    {
        // Cria 20 tarefas
        Tarefa::factory(20)->create()->each(function ($tarefa) {
            // Para cada tarefa, cria de 1 a 3 agendamentos
            Agendamento::factory(rand(1, 3))->create(['tarefa_id' => $tarefa->id]);
        });
    }
}
