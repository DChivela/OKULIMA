<?php

namespace Database\Factories;

use App\Models\Agendamento;
use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendamentoFactory extends Factory
{
    protected $model = Agendamento::class;

    public function definition()
    {
        return [
            'tarefa_id' => Tarefa::factory(),
            'data_hora' => $this->faker->dateTimeBetween('now', '+1 month'),
            'local' => $this->faker->address(),
            'observacao' => $this->faker->optional()->sentence(),
        ];
    }
}