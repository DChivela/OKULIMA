<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabalhador;

class TrabalhadorController extends Controller
{
    public function CreateTrabalhador()
    {
        return view('dashboard.trabalhadores.create');
    }

    public function StoreTrabalhador(Request $request)
    {
        $request->validate([
            'numero_profissao' => 'required|string|max:255',
            'nome_profissao' => 'required|string|max:255',
            'custo_trabalho' => 'required|numeric',
        ]);

        Trabalhador::create($request->all());

        return redirect()->route('home')->with('success', 'Trabalhador registrado com sucesso!');
    }

    public function ListTrabalhador()
    {
        $trabalhadores = Trabalhador::all();
        return view('dashboard.trabalhadores.list', compact('trabalhadores'));
    }

    public function EditTrabalhador($id)
    {
        $trabalhador = Trabalhador::findOrFail($id);
        return view('dashboard.trabalhadores.edit', compact('trabalhador'));
    }

    public function UpdateTrabalhador(Request $request, $id)
    {
        $request->validate([
            'numero_profissao' => 'required|string|max:255',
            'nome_profissao' => 'required|string|max:255',
            'custo_trabalho' => 'required|numeric',
        ]);

        $trabalhador = Trabalhador::findOrFail($id);
        $trabalhador->update($request->all());

        return redirect()->route('ListTrabalhador')->with('success', 'Trabalhador atualizado com sucesso!');
    }

    public function DeleteTrabalhador($id)
    {
        $trabalhador = Trabalhador::findOrFail($id);
        $trabalhador->delete();

        return redirect()->route('ListTrabalhador')->with('success', 'Trabalhador deletado com sucesso!');
    }
}
