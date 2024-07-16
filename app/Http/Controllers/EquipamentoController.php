<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;

class EquipamentoController extends Controller
{
    public function CreateEquipamento()
    {
        return view('dashboard.equipamentos.create');
    }

    public function StoreEquipamento(Request $request)
    {
        $request->validate([
            'numero_equipamento' => 'required|integer',
            'nome_equipamento' => 'required|string|max:255',
            'data_aquisicao' => 'required|date',
            'valor_aquisicao' => 'required|numeric',
            'vida_util' => 'required|numeric',
            'custo_hora' => 'required|numeric',
        ]);

        Equipamento::create($request->all());

        return redirect()->route('ListEquipamento')->with('success', 'Equipamento registrado com sucesso!');
    }

    public function ListEquipamento()
    {
        $equipamentos = Equipamento::all();
        return view('dashboard.equipamentos.list', compact('equipamentos'));
    }

    public function EditEquipamento($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('dashboard.equipamentos.edit', compact('equipamento'));
    }

    public function UpdateEquipamento(Request $request, $id)
    {
        $request->validate([
            'numero_equipamento' => 'required|integer',
            'nome_equipamento' => 'required|string|max:255',
            'data_aquisicao' => 'required|date',
            'valor_aquisicao' => 'required|numeric',
            'vida_util' => 'required|numeric',
            'custo_hora' => 'required|numeric',
        ]);

        $equipamento = Equipamento::findOrFail($id);
        $equipamento->update($request->all());

        return redirect()->route('ListEquipamento')->with('success', 'Equipamento atualizado com sucesso!');
    }

    public function DeleteEquipamento($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        $equipamento->delete();

        return redirect()->route('ListEquipamento')->with('success', 'Equipamento deletado com sucesso!');
    }
    public function obterCustoHora(Request $request)
    {
        $equipamentoId = $request->input('equipamento_id');
        $equipamento = Equipamento::find($equipamentoId);

        if ($equipamento) {
            return response()->json($equipamento->custo_hora);
        } else {
            return response()->json(['error' => 'Equipamento não encontrado'], 404);
        }
    }
}
