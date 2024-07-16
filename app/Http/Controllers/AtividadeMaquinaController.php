<?php

// app/Http/Controllers/AtividadeMaquinaController.php

namespace App\Http\Controllers;

use App\Models\AtividadeMaquina;
use App\Models\Equipamento;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use Illuminate\Http\Request;

class AtividadeMaquinaController extends Controller
{
    public function index()
    {
        $atividades = AtividadeMaquina::all();
        $equipamentos = Equipamento::all();
        $fazendas = Fazenda::all();
        $campos = CampoCultivo::all();

        return view('dashboard.atividades-maquinas.index', compact('atividades', 'equipamentos', 'fazendas', 'campos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'equipamentos_id' => 'required|exists:equipamentos,id',
            'fazendas_id' => 'required|exists:fazendas,id',
            'campos_cultivo_id' => 'required|exists:campos_cultivo,id',
            'data_atividade' => 'required|date',
            'hora_inicial' => 'required',
            'hora_final' => 'required',
            'duracao' => 'required|integer',
            'custo_unitario' => 'required|numeric',
            'valor_trabalho' => 'required|numeric',
        ]);

        $atividade = new AtividadeMaquina();
        $atividade->equipamentos_id = $request->equipamentos_id;
        $atividade->fazendas_id = $request->fazendas_id;
        $atividade->campos_cultivo_id = $request->campos_cultivo_id;
        $atividade->data_atividade = $request->data_atividade;
        $atividade->hora_inicial = $request->hora_inicial;
        $atividade->hora_final = $request->hora_final;
        $atividade->duracao = $request->duracao;
        $atividade->custo_unitario = $request->custo_unitario;
        $atividade->valor_trabalho = $request->valor_trabalho;

        $atividade->save();

       //AtividadeMaquina::create($request->all());

        return back()->with('success', 'Atividade registrada com sucesso.');
    }

    public function edit($id)
    {
        $atividade = AtividadeMaquina::findOrFail($id);
        $equipamentos = Equipamento::all();
        $fazendas = Fazenda::all();
        $campos = CampoCultivo::all();
        return view('dashboard.atividades-maquinas.edit', compact('atividade', 'equipamentos', 'fazendas', 'campos'));
    }

    public function update(Request $request, $id)
    {
        $atividade = AtividadeMaquina::findOrFail($id);
        $atividade->update($request->all());
        return redirect()->route('atividades-maquinas.index')->with('success', 'Atividade atualizada com sucesso.');
    }


    public function destroy(AtividadeMaquina $atividade)
    {
        $atividade->delete();
        return redirect()->back()->with('success', 'Atividade excluída com sucesso.');
    }
}
