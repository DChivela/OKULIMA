<?php

// database/factories/FazendaFactory.php

namespace Database\Factories;

use App\Models\Fazenda;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;

class FazendaFactory extends Factory
{
    protected $model = Fazenda::class;

    public function definition()
    {
        return [
            'numero_fazenda' => $this->faker->unique()->numerify('FZ###'),
            'nome_fazenda' => $this->faker->company,
            'area_fazenda' => $this->faker->randomFloat(2, 10, 100),
            'data_aquisicao' => $this->faker->date(),
            'data_exploracao' => $this->faker->date(),
            'pais_id' => Pais::factory(),
            'provincia_id' => Provincia::factory(),
            'municipio_id' => Municipio::factory(),
            'rios' => $this->faker->boolean,
            'extensao_rios' => $this->faker->randomFloat(2, 1, 10),
            'furos' => $this->faker->boolean,
            'qtd_furos' => $this->faker->numberBetween(1, 10),
            'numero_matriz' => $this->faker->unique()->numerify('MZ###'),
            'valor_predial' => $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}
