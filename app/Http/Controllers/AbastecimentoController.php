<?php

// app/Http/Controllers/AbastecimentoController.php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Equipamento;
use Illuminate\Http\Request;

class AbastecimentoController extends Controller
{
    public function index()
    {
        $abastecimentos = Abastecimento::with('equipamento')->get();
        $equipamentos = Equipamento::all();
        return view('dashboard.abastecimentos.index', compact('abastecimentos', 'equipamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'produto' => 'required|string',
            'quantidade' => 'required|numeric',
            'preco_unitario' => 'required|numeric',
            'data_abastecimento' => 'required|date',
        ]);

        Abastecimento::create($request->all());

        return redirect()->back()->with('success', 'Abastecimento registrado com sucesso.');
    }

    public function edit(Abastecimento $abastecimento)
    {
        $equipamentos = Equipamento::all();
        return view('dashboard.abastecimentos.edit', compact('abastecimento', 'equipamentos'));
    }

    public function update(Request $request, Abastecimento $abastecimento)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'produto' => 'required|string',
            'quantidade' => 'required|numeric',
            'preco_unitario' => 'required|numeric',
            'data_abastecimento' => 'required|date',
        ]);

        $abastecimento->update($request->all());

        return redirect()->view('dashboard.abastecimentos.index')->with('success', 'Abastecimento atualizado com sucesso.');
    }

    public function destroy(Abastecimento $abastecimento)
    {
        $abastecimento->delete();
        return redirect()->view('dashboard.abastecimentos.index')->with('success', 'Abastecimento excluído com sucesso.');
    }
}
