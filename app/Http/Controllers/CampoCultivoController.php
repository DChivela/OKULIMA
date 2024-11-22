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
            'numero_campo' => 'required|string',
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
            'numero_campo' => 'required|string',
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

    public function searchCampoCultivo(Request $request)
    {
        $query = $request->input('query');
        
        $campos = CampoCultivo::with('fazenda')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($q) use ($query) {
                    $q->where('numero_campo', 'LIKE', "%{$query}%")
                      ->orWhere('nome_campo', 'LIKE', "%{$query}%")
                      ->orWhereHas('fazenda', function ($q) use ($query) {
                          $q->where('nome_fazenda', 'LIKE', "%{$query}%");
                      });
                });
            })
            ->paginate(10)
            ->withQueryString();
    
        return view('dashboard.campos-cultivo.list', compact('campos'));
    }

    //Adicionar o método para buscar os campos de cultivo no controlador em função da fazenda associada
    public function getCampos($fazenda_id)
    {
        $campos = CampoCultivo::where('fazenda_id', $fazenda_id)->get();
        return response()->json($campos);
    }
}
/*
$camposCultivoResults = DB::table('campos_cultivo')
        ->join('fazendas', 'campos_cultivo.fazenda_id', '=', 'fazendas.id')
        ->select('campos_cultivo.*', 'fazendas.nome_fazenda')
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->orWhere('campos_cultivo.numero_campo', 'LIKE', "%{$query}%")
                ->orWhere('campos_cultivo.nome_campo', 'LIKE', "%{$query}%")
                ->orWhere('fazendas.nome_fazenda', 'LIKE', "%{$query}%");
        })
        ->get();

    foreach ($camposCultivoResults as $result) {
        $results[] = [
            'table' => 'campos_cultivo',
            'data' => $result
        ];
    }*/

    