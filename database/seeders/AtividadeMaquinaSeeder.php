<?php

// database/seeders/AtividadeMaquinaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AtividadeMaquina;

class AtividadeMaquinaSeeder extends Seeder
{
    public function run()
    {
        AtividadeMaquina::factory()->count(30)->create();
    }
}
