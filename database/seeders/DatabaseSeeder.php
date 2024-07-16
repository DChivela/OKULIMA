<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TrabalhadorSeeder::class,
            EquipamentoSeeder::class,
            FazendaSeeder::class,
            CampoCultivoSeeder::class,
            ProdutoSeeder::class,
            AbastecimentoSeeder::class,
            AtividadeMaquinaSeeder::class,
            AtividadeColheitaSeeder::class,
            AtividadeTrabalhadorSeeder::class,
            PaisSeeder::class,  // Adicione esta linha
            ProvinciaSeeder::class,  // Adicione esta linha
            MunicipioSeeder::class,  // Adicione esta linha
        ]);
    }
}

