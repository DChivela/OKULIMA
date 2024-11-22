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
                            <div class="card-title">Registo de Abastecimentos</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('abastecimentos.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Equipamento a Abastecer</label>
                                            <select class="form-control select2bs4" name="equipamento_id" required>
                                                <option value="">Selecione o Equipamento</option>
                                                @foreach($equipamentos as $equipamento)
                                                    <option value="{{ $equipamento->id }}">{{ $equipamento->nome_equipamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Produto</label>
                                            <select class="form-control select2bs4" name="produto" required>
                                                <option value="Gasóleo">Gasóleo</option>
                                                <option value="Gasolina">Gasolina</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Quantidade (Litros)</label>
                                            <input type="number" class="form-control" name="quantidade" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Preço Unitário</label>
                                            <input type="number" class="form-control" name="preco_unitario" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Data de Abastecimento</label>
                                            <input type="datetime-local" class="form-control" name="data_abastecimento" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary form-control">Registar Abastecimento</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="input-group mb-4 mt-2">
                         <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por postos...">
                    </div>
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Consulta de Abastecimentos</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Equipamento</th>
                                        <th>Produto</th>
                                        <th>Quantidade (Litros)</th>
                                        <th>Preço Unitário</th>
                                        <th>Data de Abastecimento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abastecimentos as $abastecimento)
                                        <tr class="posto-item">
                                            <td class="nome">{{ $abastecimento->equipamento->nome_equipamento }}</td>
                                            <td class="produto">{{ $abastecimento->produto }}</td>
                                            <td class="quantidade">{{ $abastecimento->quantidade }}</td>
                                            <td class="preco">{{ number_format($abastecimento->preco_unitario, 2, ',', '.') }} AOA</td>
                                            <td>{{ $abastecimento->data_abastecimento }}</td>
                                            <td>
                                                <a href="{{ route('abastecimentos.edit', $abastecimento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('abastecimentos.destroy', $abastecimento->id) }}" method="post" style="display:inline-block;">
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

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){

        const searchquery = document.getElementById("searchQuery")

        const postoRow = document.querySelectorAll(".posto-item")

        searchQuery.addEventListener("keyup", function(){

            const query = searchQuery.value.toLowerCase();

            postoRow.forEach(element => {
                const nome = element.querySelector(".nome").textContent.toLowerCase();
                const produto = element.querySelector(".produto").textContent.toLowerCase();
                const quantidade = element.querySelector(".quantidade").textContent.toLowerCase();
                const preco = element.querySelector(".preco").textContent.toLowerCase();
                if (nome.includes(query) || produto.includes(query) || quantidade.includes(query) || preco.includes(query)) {
                    element.style.display=""
                } else {
                    element.style.display="none"
                    
                }
            });
        })


    })

</script>