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
                            <div class="card-title">Lista de Fazendas</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº Interno</th>
                                        <th>Nome da Fazenda</th>
                                        <th>Área (Hectares)</th>
                                        <th>País</th>
                                        <th>Província</th>
                                        <th>Município</th>
                                        <th>Data de Aquisição</th>
                                        <th>Data de Início de Exploração</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fazendas as $fazenda)
                                        <tr>
                                            <td>{{ $fazenda->numero_fazenda }}</td>
                                            <td>{{ $fazenda->nome_fazenda }}</td>
                                            <td>{{ $fazenda->area_fazenda }}</td>
                                            <td>{{ $fazenda->pais->nome }}</td>
                                            <td>{{ $fazenda->provincia->nome }}</td>
                                            <td>{{ $fazenda->municipio->nome }}</td>
                                            <td>{{ $fazenda->data_aquisicao }}</td>
                                            <td>{{ $fazenda->data_exploracao }}</td>
                                            <td>
                                                <a href="{{ route('fazendas.edit', $fazenda->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('fazendas.destroy', $fazenda->id) }}" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $fazendas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
