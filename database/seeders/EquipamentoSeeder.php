<?php

// database/seeders/EquipamentoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipamento;

class EquipamentoSeeder extends Seeder
{
    public function run()
    {
        Equipamento::factory()->count(30)->create();
    }
}
