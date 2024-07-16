<?php

// database/seeders/AtividadeColheitaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AtividadeColheita;

class AtividadeColheitaSeeder extends Seeder
{
    public function run()
    {
        AtividadeColheita::factory()->count(30)->create();
    }
}
