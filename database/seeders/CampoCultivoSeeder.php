<?php

// database/seeders/CampoCultivoSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampoCultivo;

class CampoCultivoSeeder extends Seeder
{
    public function run()
    {
        CampoCultivo::factory()->count(30)->create();
    }
}
