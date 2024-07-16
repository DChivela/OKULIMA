<!-- resources/views/produtos/produtos/index.blade.php -->

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
                            <div class="card-title">Registo de Produtos</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produtos.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cod. Produto</label>
                                            <input type="text" class="form-control" name="cod_produto" placeholder="Ex: 001" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Nome Produto</label>
                                            <input type="text" class="form-control" name="nome_produto" placeholder="Ex: Banana" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input type="text" class="form-control" name="preco_produto" placeholder="Ex: 10,00" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Registar Produto</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Consulta de Produtos</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Cod Produto</th>
                                        <th>Nome Produto</th>
                                        <th>Preço Produto</th>
                                        <th>Data Registo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produtos as $produto)
                                        <tr>
                                            <td>{{ $produto->cod_produto }}</td>
                                            <td>{{ $produto->nome_produto }}</td>
                                            <td>{{ number_format($produto->preco_produto, 2, ',', '.') }} AOA</td>
                                            <td>{{ $produto->created_at }}</td>
                                            <td>
                                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="post" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
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
