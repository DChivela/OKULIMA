<?php

// database/seeders/AbastecimentoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Abastecimento;

class AbastecimentoSeeder extends Seeder
{
    public function run()
    {
        Abastecimento::factory()->count(30)->create();
    }
}
