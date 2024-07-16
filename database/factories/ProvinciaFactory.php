<?php

// database/factories/ProvinciaFactory.php

namespace Database\Factories;

use App\Models\Provincia;
use App\Models\Pais;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinciaFactory extends Factory
{
    protected $model = Provincia::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->state,
            'pais_id' => Pais::factory(),
        ];
    }
}
