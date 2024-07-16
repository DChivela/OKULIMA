<?php

// database/seeders/MunicipioSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run()
    {
        Municipio::factory()->count(30)->create();
    }
}
