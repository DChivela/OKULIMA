<?php

namespace App\Http\Controllers;

use App\Models\Fazenda;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;
use Illuminate\Http\Request;

class FazendaController extends Controller
{
    public function index()
    {
        $fazendas = Fazenda::with('pais', 'provincia', 'municipio')->paginate(10); // Adjust the number of items per page as needed
        return view('dashboard.fazendas.list', compact('fazendas'));
    }

    public function create()
    {
        $paises = Pais::all();
        return view('dashboard.fazendas.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_fazenda' => 'required|string|max:255',
            'nome_fazenda' => 'required|string|max:255',
            'area_fazenda' => 'required|numeric',
            'data_aquisicao' => 'required|date',
            'data_exploracao' => 'required|date',
            'pais_id' => 'required|exists:paises,id',
            'provincia_id' => 'required|exists:provincias,id',
            'municipio_id' => 'required|exists:municipios,id',
            'rios' => 'required|boolean',
            'extensao_rios' => 'nullable|numeric',
            'furos' => 'required|boolean',
            'qtd_furos' => 'nullable|integer',
            'numero_matriz' => 'required|string|max:255',
            'valor_predial' => 'required|numeric',
        ]);

        Fazenda::create($request->all());

        return redirect()->route('fazendas.index')->with('success', 'Fazenda criada com sucesso!');
    }

    public function edit(Fazenda $fazenda)
    {
        $paises = Pais::all();
        return view('dashboard.fazendas.edit', compact('fazenda', 'paises'));
    }

    public function update(Request $request, Fazenda $fazenda)
    {
        $request->validate([
            'numero_fazenda' => 'required|string|max:255',
            'nome_fazenda' => 'required|string|max:255',
            'area_fazenda' => 'required|numeric',
            'data_aquisicao' => 'required|date',
            'data_exploracao' => 'required|date',
            'pais_id' => 'required|exists:paises,id',
            'provincia_id' => 'required|exists:provincias,id',
            'municipio_id' => 'required|exists:municipios,id',
            'rios' => 'required|boolean',
            'extensao_rios' => 'nullable|numeric',
            'furos' => 'required|boolean',
            'qtd_furos' => 'nullable|integer',
            'numero_matriz' => 'required|string|max:255',
            'valor_predial' => 'required|numeric',
        ]);

        $fazenda->update($request->all());

        return redirect()->route('fazendas.index')->with('success', 'Fazenda atualizada com sucesso!');
    }

    public function destroy(Fazenda $fazenda)
    {
        $fazenda->delete();
        return redirect()->route('fazendas.index')->with('success', 'Fazenda deletada com sucesso!');
    }
}
