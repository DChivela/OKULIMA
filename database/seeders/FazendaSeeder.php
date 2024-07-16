<?php

// database/seeders/FazendaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fazenda;

class FazendaSeeder extends Seeder
{
    public function run()
    {
        Fazenda::factory()->count(30)->create();
    }
}
