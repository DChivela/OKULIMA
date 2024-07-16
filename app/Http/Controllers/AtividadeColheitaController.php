<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fazenda;
use App\Models\CampoCultivo;
use App\Models\AtividadeColheita;
use Illuminate\Http\Request;

class AtividadeColheitaController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        $fazendas = Fazenda::all();
        $campos = CampoCultivo::all();
        $atividades = AtividadeColheita::all();

        return view('dashboard.atividades-colheitas.index', compact('produtos', 'fazendas', 'campos', 'atividades'));
    }

    public function store(Request $request)
    {
        $atividade = new AtividadeColheita($request->all());
        $atividade->save();

        return redirect()->route('atividades-colheitas.index')->with('success', 'Atividade de colheita registrada com sucesso!');
    }

    public function edit($id)
    {
        $atividade = AtividadeColheita::findOrFail($id);
        $produtos = Produto::all();
        $fazendas = Fazenda::all();
        $campos = CampoCultivo::all();

        return view('dashboard.atividades-colheitas.edit', compact('atividade', 'produtos', 'fazendas', 'campos'));
    }

    public function update(Request $request, $id)
    {
        $atividade = AtividadeColheita::findOrFail($id);
        $atividade->update($request->all());

        return redirect()->route('atividades-colheitas.index')->with('success', 'Atividade de colheita atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $atividade = AtividadeColheita::findOrFail($id);
        $atividade->delete();

        return redirect()->route('atividades-colheitas.index')->with('success', 'Atividade de colheita excluída com sucesso!');
    }

    public function obterPrecoProduto(Request $request)
    {
        $produto = Produto::findOrFail($request->produto_id);
        return response()->json($produto->preco_produto);
    }
}
