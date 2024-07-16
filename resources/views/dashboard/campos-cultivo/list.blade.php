@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Lista de Campos de Cultivo</div>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('campos-cultivo.create') }}" class="btn btn-success mb-3">Registrar Novo Campo</a>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº Interno</th>
                                        <th>Nome do Campo</th>
                                        <th>Área (Hectares)</th>
                                        <th>Fazenda Associada</th>
                                        <th>Data de Início de Exploração</th>
                                        <th>Sistema de Irrigação</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campos as $campo)
                                        <tr>
                                            <td>{{ $campo->numero_campo }}</td>
                                            <td>{{ $campo->nome_campo }}</td>
                                            <td>{{ $campo->area_campo }}</td>
                                            <td>{{ $campo->fazenda->nome_fazenda }}</td>
                                            <td>{{ $campo->data_exploracao }}</td>
                                            <td>{{ $campo->sistema_irrigacao }}</td>
                                            <td>
                                                <a href="{{ route('campos-cultivo.edit', $campo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('campos-cultivo.destroy', $campo->id) }}" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $campos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
