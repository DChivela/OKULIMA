<?php

// database/factories/AtividadeTrabalhadorFactory.php

namespace Database\Factories;

use App\Models\AtividadeTrabalhador;
use App\Models\Trabalhador;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtividadeTrabalhadorFactory extends Factory
{
    protected $model = AtividadeTrabalhador::class;

    public function definition()
    {
        return [
            'trabalhador_id' => Trabalhador::factory(),
            'fazenda_id' => Fazenda::factory(),
            'campo_cultivo_id' => CampoCultivo::factory(),
            'data' => $this->faker->date(),
            'hora_inicial' => $this->faker->time(),
            'hora_final' => $this->faker->time(),
            'duracao' => $this->faker->numberBetween(1, 480), // duração em minutos
            'custo_unitario' => $this->faker->randomFloat(500, 1000, 2000),
            'valor_trabalho' => $this->faker->randomFloat(2000, 5000, 10009, 30000),
        ];
    }
}
