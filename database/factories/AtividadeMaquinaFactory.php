<?php

// database/factories/AtividadeMaquinaFactory.php

namespace Database\Factories;

use App\Models\AtividadeMaquina;
use App\Models\Equipamento;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtividadeMaquinaFactory extends Factory
{
    protected $model = AtividadeMaquina::class;

    public function definition()
    {
        return [
            'equipamentos_id' => Equipamento::factory(),
            'fazendas_id' => Fazenda::factory(),
            'campos_cultivo_id' => CampoCultivo::factory(),
            'data_atividade' => $this->faker->date(),
            'hora_inicial' => $this->faker->time(),
            'hora_final' => $this->faker->time(),
            'duracao' => $this->faker->numberBetween(1, 480), // duração em minutos
            'custo_unitario' => $this->faker->randomFloat(500, 1000, 2000),
            'valor_trabalho' => $this->faker->randomFloat(2000, 5000, 10009, 30000),
        ];
    }
}
