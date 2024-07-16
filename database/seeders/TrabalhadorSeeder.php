<?php

// database/seeders/TrabalhadorSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trabalhador;

class TrabalhadorSeeder extends Seeder
{
    public function run()
    {
        Trabalhador::factory()->count(30)->create();
    }
}
