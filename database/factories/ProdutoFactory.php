<?php

// database/factories/ProdutoFactory.php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'cod_produto' => $this->faker->unique()->numerify('PRD###'),
            'nome_produto' => $this->faker->word,
            'preco_produto' => $this->faker->randomFloat(200, 1000, 100),
        ];
    }
}
