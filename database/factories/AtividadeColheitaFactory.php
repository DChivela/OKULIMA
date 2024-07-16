<?php

// database/factories/AtividadeColheitaFactory.php

namespace Database\Factories;

use App\Models\AtividadeColheita;
use App\Models\Produto;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtividadeColheitaFactory extends Factory
{
    protected $model = AtividadeColheita::class;

    public function definition()
    {
        return [
            'produto_id' => Produto::factory(),
            'fazenda_id' => Fazenda::factory(),
            'campo_cultivo_id' => CampoCultivo::factory(),
            'data' => $this->faker->date(),
            'hora_inicial' => $this->faker->time(),
            'hora_final' => $this->faker->time(),
            'duracao' => $this->faker->numberBetween(1, 480),
            'custo_unitario' => $this->faker->randomFloat(500, 1000, 2000),
            'valor_colheita' => $this->faker->randomFloat(2000, 5000, 10009, 30000),
        ];
    }
}
