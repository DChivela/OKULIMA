<?php

// database/seeders/TrabalhadorSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TrabalhadorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {  // Ajuste o número conforme necessário
            DB::table('trabalhadores')->insert([
                'numero_profissao' => $faker->numerify('###-###'),
                'nome_profissao' => $faker->word,
                'nome_trabalhador' => $faker->name,  // Adicionando o nome do trabalhador
                'custo_trabalho' => $faker->randomFloat(2, 500, 5000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
