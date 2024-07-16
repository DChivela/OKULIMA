<?php

// database/factories/MunicipioFactory.php

namespace Database\Factories;

use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\Factory;

class MunicipioFactory extends Factory
{
    protected $model = Municipio::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->city,
            'provincia_id' => Provincia::factory(),
        ];
    }
}
