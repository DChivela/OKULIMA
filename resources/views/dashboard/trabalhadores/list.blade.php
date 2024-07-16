@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table m-0">
            <thead>
                <tr>
                    <th>Número de profissão</th>
                    <th>Nome da profissão</th>
                    <th>Custo por Hora</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trabalhadores as $trabalhador)
                <tr>
                    <td>{{ $trabalhador->numero_profissao }}</td>
                    <td>{{ $trabalhador->nome_profissao }}</td>
                    <td>{{ $trabalhador->custo_trabalho }} AOA</td>
                    <td>
                        <a href="{{ route('EditTrabalhador', $trabalhador->id) }}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('DeleteTrabalhador', $trabalhador->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este trabalhador?');"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
