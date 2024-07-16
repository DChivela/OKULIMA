<?php

// database/factories/CampoCultivoFactory.php

namespace Database\Factories;

use App\Models\CampoCultivo;
use App\Models\Fazenda;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampoCultivoFactory extends Factory
{
    protected $model = CampoCultivo::class;

    public function definition()
    {
        return [
            'fazenda_id' => Fazenda::factory(),
            'numero_campo' => $this->faker->unique()->numerify('CP###'),
            'nome_campo' => $this->faker->word,
            'area_campo' => $this->faker->randomFloat(2, 1, 10),
            'data_exploracao' => $this->faker->date(),
            'sistema_irrigacao' => $this->faker->word,
        ];
    }
}
