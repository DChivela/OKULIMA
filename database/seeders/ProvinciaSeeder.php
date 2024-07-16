<?php

// database/seeders/ProvinciaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciaSeeder extends Seeder
{
    public function run()
    {
        Provincia::factory()->count(30)->create();
    }
}
