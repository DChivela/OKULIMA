<?php

// database/factories/AbastecimentoFactory.php

namespace Database\Factories;

use App\Models\Abastecimento;
use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbastecimentoFactory extends Factory
{
    protected $model = Abastecimento::class;

    public function definition()
    {
        return [
            'equipamento_id' => Equipamento::factory(),
            'produto' => $this->faker->word,
            'quantidade' => $this->faker->randomFloat(2, 1, 200),
            'preco_unitario' => $this->faker->randomFloat(500, 1000, 2000),
            'data_abastecimento' => $this->faker->dateTime,
        ];
    }
}
