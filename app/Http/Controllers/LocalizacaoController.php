<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;

class LocalizacaoController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        $provincias = Provincia::all();
        $municipios = Municipio::all();

        return view('dashboard.localizacoes.index', compact('paises', 'provincias', 'municipios'));
    }

    public function storePais(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Pais::create($request->all());

        return redirect()->back()->with('success', 'País registrado com sucesso');
    }

    public function storeProvincia(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'pais_id' => 'required|exists:paises,id',
        ]);

        Provincia::create($request->all());

        return redirect()->back()->with('success', 'Província registrada com sucesso');
    }

    public function storeMunicipio(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'provincia_id' => 'required|exists:provincias,id',
        ]);

        Municipio::create($request->all());

        return redirect()->back()->with('success', 'Município registrado com sucesso');
    }

    public function destroyPais($id)
    {
        $pais = Pais::findOrFail($id);
        $pais->delete();

        return redirect()->back()->with('success', 'País deletado com sucesso');
    }

    public function destroyProvincia($id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->delete();

        return redirect()->back()->with('success', 'Província deletada com sucesso');
    }

    public function destroyMunicipio($id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();

        return redirect()->back()->with('success', 'Município deletado com sucesso');
    }

    public function getProvincias($pais_id)
    {
        $provincias = Provincia::where('pais_id', $pais_id)->get();
        return response()->json($provincias);
    }

    public function getMunicipios($provincia_id)
    {
        $municipios = Municipio::where('provincia_id', $provincia_id)->get();
        return response()->json($municipios);
    }
}

