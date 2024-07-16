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
                            <div class="card-title">Lista de Equipamentos</div>
                        </div>
                        <div class="card-body">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Número do Equipamento</th>
                                        <th>Nome do Equipamento</th>
                                        <th>Data de Aquisição</th>
                                        <th>Valor da Aquisição</th>
                                        <th>Vida Util</th>
                                        <th>Custo por Hora</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($equipamentos as $equipamento)
                                    <tr>
                                        <td>{{ $equipamento->numero_equipamento }}</td>
                                        <td>{{ $equipamento->nome_equipamento }}</td>
                                        <td>{{ $equipamento->data_aquisicao }}</td>
                                        <td>{{ $equipamento->valor_aquisicao }}</td>
                                        <td>{{ $equipamento->vida_util }}</td>
                                        <td>{{ $equipamento->custo_hora }}</td>
                                        <td>
                                            <a href="{{ route('EditEquipamento', $equipamento->id) }}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('DeleteEquipamento', $equipamento->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este equipamento?');"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
