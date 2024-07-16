<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampoCultivo;
use App\Models\Fazenda;

class CampoCultivoController extends Controller
{
    public function index()
    {
        $campos = CampoCultivo::with('fazenda')->paginate(10);
        return view('dashboard.campos-cultivo.list', compact('campos'));
    }

    public function create()
    {
        $fazendas = Fazenda::all();
        return view('dashboard.campos-cultivo.create', compact('fazendas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_campo' => 'required|numeric',
            'nome_campo' => 'required|string',
            'area_campo' => 'required|numeric',
            'fazenda_associada' => 'required|exists:fazendas,id',
            'data_exploracao' => 'required|date',
            'sistema_irrigacao' => 'required|string',
        ]);

        $data = $request->all();
        $data['fazenda_id'] = $request->fazenda_associada;

        CampoCultivo::create($data);

        return redirect()->route('campos-cultivo.index')->with('success', 'Campo de Cultivo registrado com sucesso.');
    }

    public function edit($id)
    {
        $campo = CampoCultivo::findOrFail($id);
        $fazendas = Fazenda::all();
        return view('dashboard.campos-cultivo.edit', compact('campo', 'fazendas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_campo' => 'required|numeric',
            'nome_campo' => 'required|string',
            'area_campo' => 'required|numeric',
            'fazenda_associada' => 'required|exists:fazendas,id',
            'data_exploracao' => 'required|date',
            'sistema_irrigacao' => 'required|string',
        ]);

        $campo = CampoCultivo::findOrFail($id);
        $campo->update($request->all());
        return redirect()->route('campos-cultivo.index')->with('success', 'Campo de Cultivo atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $campo = CampoCultivo::findOrFail($id);
        $campo->delete();
        return redirect()->route('campos-cultivo.index')->with('success', 'Campo de Cultivo deletado com sucesso.');
    }
}
