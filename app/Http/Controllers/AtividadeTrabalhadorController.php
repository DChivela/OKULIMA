<?php

namespace App\Http\Controllers;

use App\Models\AtividadeTrabalhador;
use App\Models\Trabalhador;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use Illuminate\Http\Request;
use App\Http\Controllers\TrabalhadorController;

class AtividadeTrabalhadorController extends Controller
{
    public function index()
    {
        $atividades = AtividadeTrabalhador::with('trabalhador', 'fazenda', 'campoCultivo')->get();
        return view('dashboard.atividades-trabalhador.index', compact('atividades'));
    }

    public function create()
    {
        $trabalhadores = Trabalhador::all();
        $fazendas = Fazenda::all();
        $campos = CampoCultivo::all();
        return view('dashboard.atividades-trabalhador.create', compact('trabalhadores', 'fazendas', 'campos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trabalhador_id' => 'required',
            'fazenda_id' => 'required',
            'campo_cultivo_id' => 'required',
            'data' => 'required|date',
            'hora_inicial' => 'required',
            'hora_final' => 'required',
            'duracao' => 'required|numeric',
            'custo_unitario' => 'required|numeric',
            'valor_trabalho' => 'required|numeric',
        ]);

        AtividadeTrabalhador::create($request->all());
        return redirect()->route('atividades-trabalhador.index')->with('success', 'Atividade registrada com sucesso!');
    }

    public function edit($id)
    {
        $atividade = AtividadeTrabalhador::findOrFail($id);
        $trabalhadores = Trabalhador::all();
        $fazendas = Fazenda::all();
        $campos = CampoCultivo::all();
        return view('dashboard.atividades-trabalhador.edit', compact('atividade', 'trabalhadores', 'fazendas', 'campos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'trabalhador_id' => 'required',
            'fazenda_id' => 'required',
            'campo_cultivo_id' => 'required',
            'data' => 'required|date',
            'hora_inicial' => 'required',
            'hora_final' => 'required',
            'duracao' => 'required|numeric',
            'custo_unitario' => 'required|numeric',
            'valor_trabalho' => 'required|numeric',
        ]);

        $atividade = AtividadeTrabalhador::findOrFail($id);
        $atividade->update($request->all());
        return redirect()->route('atividades-trabalhador.index')->with('success', 'Atividade atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $atividade = AtividadeTrabalhador::findOrFail($id);
        $atividade->delete();
        return redirect()->route('atividades-trabalhador.index')->with('success', 'Atividade excluída com sucesso!');
    }

    public function obterCustoTrabalhador(Request $request)
    {
        $trabalhador = Trabalhador::findOrFail($request->trabalhador_id);
        return response()->json($trabalhador->custo_trabalho);
    }
}
