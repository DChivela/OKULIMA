<?php

// database/factories/TrabalhadorFactory.php

namespace Database\Factories;

use App\Models\Trabalhador;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrabalhadorFactory extends Factory
{
    protected $model = Trabalhador::class;

    public function definition()
    {
        return [
            'numero_profissao' => $this->faker->unique()->numerify('###-###'),
            'nome_profissao' => $this->faker->jobTitle,
            'custo_trabalho' => $this->faker->randomFloat(2000, 1000, 1200),
        ];
    }
}
