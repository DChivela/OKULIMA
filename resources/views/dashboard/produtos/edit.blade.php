<!-- resources/views/produtos/produtos/edit.blade.php -->

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
                            <div class="card-title">Editar Produto</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produtos.update', $produto->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cod. Produto</label>
                                            <input type="text" class="form-control" name="cod_produto" value="{{ $produto->cod_produto }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Nome Produto</label>
                                            <input type="text" class="form-control" name="nome_produto" value="{{ $produto->nome_produto }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input type="text" class="form-control" name="preco_produto" value="{{ $produto->preco_produto }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Atualizar Produto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
