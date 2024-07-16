<?php
// app/Http/Controllers/ProdutoController.php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('dashboard.produtos.index', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cod_produto' => 'required|string',
            'nome_produto' => 'required|string',
            'preco_produto' => 'required|numeric',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto registrado com sucesso.');
    }

    public function edit(Produto $produto)
    {
        return view('dashboard.produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'cod_produto' => 'required|string',
            'nome_produto' => 'required|string',
            'preco_produto' => 'required|numeric',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
    }
}
