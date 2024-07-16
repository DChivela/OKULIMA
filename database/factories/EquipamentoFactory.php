<?php

// database/factories/EquipamentoFactory.php

namespace Database\Factories;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipamentoFactory extends Factory
{
    protected $model = Equipamento::class;

    public function definition()
    {
        return [
            'numero_equipamento' => $this->faker->unique()->randomNumber(),
            'nome_equipamento' => $this->faker->word,
            'data_aquisicao' => $this->faker->date(),
            'valor_aquisicao' => $this->faker->randomFloat(2000, 5000, 10009, 30000),
            'vida_util' => $this->faker->randomFloat(20, 50, 10, 30),
            'custo_hora' => $this->faker->randomFloat(2000, 5000, 1009, 3000),
        ];
    }
}
