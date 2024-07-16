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

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        $tables = [
            'users' => ['id', 'name', 'email'],
            'trabalhadores' => ['id', 'numero_profissao', 'nome_profissao'],
            'equipamentos' => ['id', 'numero_equipamento', 'nome_equipamento'],
            'fazendas' => ['id', 'numero_fazenda', 'nome_fazenda'],
            'campos_cultivo' => ['id', 'numero_campo', 'nome_campo'],
            'produtos' => ['id', 'cod_produto', 'nome_produto'],
            'abastecimentos' => ['id', 'produto'],
            'atividades_maquinas' => ['id', 'data_atividade'],
            'atividade_colheitas' => ['id', 'data'],
            'atividades_trabalhador' => ['id', 'data']
        ];

        foreach ($tables as $table => $columns) {
            $queryBuilder = DB::table($table);
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', "%{$query}%");
            }
            $queryResults = $queryBuilder->get();
            foreach ($queryResults as $result) {
                $results[] = [
                    'table' => $table,
                    'data' => $result
                ];
            }
        }

        return response()->json($results);
    }

    public function showSearch()
    {
        return view('dashboard.home.search');
    }
}
