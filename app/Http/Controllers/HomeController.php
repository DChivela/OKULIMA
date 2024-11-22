<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use App\Models\Trabalhador;
use App\Models\Abastecimento;
use App\Models\AtividadeColheita;
use App\Models\AtividadeMaquina;
use App\Models\AtividadeTrabalhador;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $equipamentos = Equipamento::all();
        $fazendas = Fazenda::with(['pais', 'provincia', 'municipio'])->get();
        $trabalhadores = Trabalhador::all();
        $CamposCultivos = CampoCultivo::all();

        $abastecimentos = Abastecimento::all();
        $atividades_colheita = AtividadeColheita::all();
        $atividades_maquina = AtividadeMaquina::all();
        $atividades_trabalhador = AtividadeTrabalhador::all();

        $meses = [];
        $abastecimento_mensal = [];
        $atividade_colheita_mensal = [];

        for ($i = 0; $i < 12; $i++) {
            $mes = Carbon::now()->subMonths($i)->format('Y-m');
            $meses[] = $mes;
            $abastecimento_mensal[] = $abastecimentos->where('created_at', 'like', "$mes%")->count();
            $atividade_colheita_mensal[] = $atividades_colheita->where('created_at', 'like', "$mes%")->count();
        }

        $meses = array_reverse($meses);
        $abastecimento_mensal = array_reverse($abastecimento_mensal);
        $atividade_colheita_mensal = array_reverse($atividade_colheita_mensal);

        return view('dashboard.home.home', [
            'equipamentos' => $equipamentos,
            'fazendas' => $fazendas,
            'trabalhadores' => $trabalhadores,
            'CamposCultivos' => $CamposCultivos,
            'abastecimento_mensal' => $abastecimento_mensal,
            'atividade_colheita_mensal' => $atividade_colheita_mensal,
            'meses' => $meses,
            'abastecimento_total' => $abastecimentos->count(),
            'atividade_colheita_total' => $atividades_colheita->count(),
            'atividade_maquina_total' => $atividades_maquina->count(),
            'atividade_trabalhador_total' => $atividades_trabalhador->count(),
        ]);
    }

    //     Divisão da busca em duas partes:
    // Busca com joins para as tabelas que necessitam.
    // Busca simples para as tabelas que não precisam de joins.



    public function search(Request $request)
{
    $query = $request->input('query');
    $results = [];

    // 1. Busca simples para as outras tabelas
    $simpleTables = [
        'users' => ['id', 'name', 'email'],
        'trabalhadores' => ['id', 'numero_profissao', 'nome_profissao', 'nome_trabalhador'],
        'equipamentos' => ['id', 'numero_equipamento', 'nome_equipamento'],
        'produtos' => ['id', 'cod_produto', 'nome_produto'],
        'atividade_colheitas' => ['id', 'data'],
        'atividades_trabalhador' => ['id', 'data'],
        'fazendas' => ['id', 'nome_fazenda']
    ];

    foreach ($simpleTables as $table => $columns) {
        $queryBuilder = DB::table($table);

        // Aplicar a busca nas colunas relevantes
        $queryBuilder->where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', "%{$query}%");
            }
        });

        $queryResults = $queryBuilder->get();

        foreach ($queryResults as $result) {
            $results[] = [
                'table' => $table,
                'data' => $result
            ];
        }
    }

    // 2. Busca com Join para a tabela 'campos_cultivo' e 'fazendas'
    $camposCultivoResults = DB::table('campos_cultivo')
        ->join('fazendas', 'campos_cultivo.fazenda_id', '=', 'fazendas.id')
        ->select('campos_cultivo.*', 'fazendas.nome_fazenda')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('campos_cultivo.numero_campo', 'LIKE', "%{$query}%")
                ->orWhere('campos_cultivo.nome_campo', 'LIKE', "%{$query}%")
                ->orWhere('fazendas.nome_fazenda', 'LIKE', "%{$query}%");
        })
        ->get();

    foreach ($camposCultivoResults as $result) {
        $results[] = [
            'table' => 'campos_cultivo',
            'data' => $result
        ];
    }

    // 3. Busca com Join para a tabela 'abastecimentos' e 'equipamentos'
    $abastecimentosResults = DB::table('abastecimentos')
        ->join('equipamentos', 'abastecimentos.equipamento_id', '=', 'equipamentos.id')
        ->select('abastecimentos.*', 'equipamentos.nome_equipamento', 'equipamentos.numero_equipamento')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('abastecimentos.produto', 'LIKE', "%{$query}%")
                ->orWhere('equipamentos.nome_equipamento', 'LIKE', "%{$query}%")
                ->orWhere('equipamentos.numero_equipamento', 'LIKE', "%{$query}%");
        })
        ->get();

    foreach ($abastecimentosResults as $result) {
        $results[] = [
            'table' => 'abastecimentos',
            'data' => $result
        ];
    }

    // 4. Busca com Join para a tabela 'atividades_trabalhador', 'trabalhadores', 'fazendas' e 'campos_cultivo'
    $atividadesTrabalhadorResults = DB::table('atividades_trabalhador')
        ->join('trabalhadores', 'atividades_trabalhador.trabalhador_id', '=', 'trabalhadores.id')
        ->join('fazendas', 'atividades_trabalhador.fazenda_id', '=', 'fazendas.id')
        ->join('campos_cultivo', 'atividades_trabalhador.campo_cultivo_id', '=', 'campos_cultivo.id')
        ->select(
            'atividades_trabalhador.*',
            'trabalhadores.nome_trabalhador',
            'fazendas.nome_fazenda',
            'campos_cultivo.nome_campo'
        )
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('atividades_trabalhador.data', 'LIKE', "%{$query}%")
                ->orWhere('atividades_trabalhador.hora_inicial', 'LIKE', "%{$query}%")
                ->orWhere('trabalhadores.nome_trabalhador', 'LIKE', "%{$query}%")
                ->orWhere('fazendas.nome_fazenda', 'LIKE', "%{$query}%")
                ->orWhere('campos_cultivo.nome_campo', 'LIKE', "%{$query}%")
                ->orWhere('atividades_trabalhador.duracao', '=', $query)
                ->orWhere('atividades_trabalhador.custo_unitario', '=', $query)
                ->orWhere('atividades_trabalhador.valor_trabalho', '=', $query)
                ->orWhere('atividades_trabalhador.tipo_atividade', 'LIKE', "%{$query}%");
        })
        ->get();

    foreach ($atividadesTrabalhadorResults as $result) {
        $results[] = [
            'table' => 'atividades_trabalhador',
            'data' => $result
        ];
    }

    // 5. Busca com Join para a tabela 'atividades_colheita', 'fazendas' e 'campos_cultivo'
    $atividadesColheitaResults = DB::table('atividade_colheitas')
        ->join('fazendas', 'atividade_colheitas.fazenda_id', '=', 'fazendas.id')
        ->join('campos_cultivo', 'atividade_colheitas.campo_cultivo_id', '=', 'campos_cultivo.id')
        ->select(
            'atividade_colheitas.*',
            'fazendas.nome_fazenda',
            'campos_cultivo.nome_campo'
        )
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('atividade_colheitas.data', 'LIKE', "%{$query}%")
                ->orWhere('atividade_colheitas.hora_inicial', 'LIKE', "%{$query}%")
                ->orWhere('atividade_colheitas.hora_final', 'LIKE', "%{$query}%")
                ->orWhere('fazendas.nome_fazenda', 'LIKE', "%{$query}%")
                ->orWhere('campos_cultivo.nome_campo', 'LIKE', "%{$query}%");
        })
        ->get();

    foreach ($atividadesColheitaResults as $result) {
        $results[] = [
            'table' => 'atividade_colheitas',
            'data' => $result
        ];
    }



    // ... (código existente para as outras tabelas)

    // 5. Busca com Join para a tabela 'paises'
    $paisesResults = DB::table('paises')
        ->select('paises.*')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('paises.nome', 'LIKE', "%{$query}%"); // Pesquisa pelo nome do país
        })
        ->get();

    foreach ($paisesResults as $result) {
        $results[] = [
            'table' => 'paises',
            'data' => $result
        ];
    }

    // 6. Busca com Join para a tabela 'provincias'
    $provinciasResults = DB::table('provincias')
        ->join('paises', 'provincias.pais_id', '=', 'paises.id') // Junção com a tabela 'paises'
        ->select('provincias.*', 'paises.nome as nome_pais') // Seleciona todos os campos da tabela 'provincias' e o nome do país
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('provincias.nome', 'LIKE', "%{$query}%") // Pesquisa pelo nome da província
                ->orWhere('paises.nome', 'LIKE', "%{$query}%"); // Pesquisa pelo nome do país
        })
        ->get();

    foreach ($provinciasResults as $result) {
        $results[] = [
            'table' => 'provincias',
            'data' => $result
        ];
    }

    // Retornar os resultados em JSON
    return response()->json($results);
}


    // Retornar os resultados em JSON




    public function showSearch()
    {
        return view('dashboard.home.search');
        
    }
}
