<?php

// database/seeders/AtividadeTrabalhadorSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AtividadeTrabalhador;

class AtividadeTrabalhadorSeeder extends Seeder
{
    public function run()
    {
        AtividadeTrabalhador::factory()->count(30)->create();
    }
}
