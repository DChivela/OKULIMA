@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                <div class="input-group mb-4 mt-2">
    <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por atividades...">
</div>
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Lista de Atividades de Trabalhador</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Trabalhador</th>
                                        <th>Fazenda</th>
                                        <th>Campo</th>
                                        <th>Atividade</th>
                                        <th>Data</th>
                                        <th>Hora Inicial</th>
                                        <th>Hora Final</th>
                                        <th>Duração (min)</th>
                                        <th>Custo Unitário (AOA)</th>
                                        <th>Valor do Trabalho (AOA)</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($atividades as $atividade)
                                        <tr class="atividade-item">
                                            <td class="nome">{{ $atividade->trabalhador->nome_trabalhador }}</td>
                                            <td class="nome-fazenda">{{ $atividade->fazenda->nome_fazenda }}</td>
                                            <td class="nome-campo">{{ $atividade->campoCultivo->nome_campo }}</td>
                                            <td class="tipo">{{ $atividade->tipo_atividade }}</td>
                                            <td>{{ $atividade->data }}</td>
                                            <td>{{ $atividade->hora_inicial }}</td>
                                            <td>{{ $atividade->hora_final }}</td>
                                            <td>{{ $atividade->duracao }}</td>
                                            <td>{{ number_format($atividade->custo_unitario, 2, ',', '.') }}</td>
                                            <td>{{ number_format($atividade->valor_trabalho, 2, ',', '.') }}</td>
                                            <td>
                                                <a href="{{ route('atividades-trabalhador.edit', $atividade->id) }}" class="btn btn-primary">Editar</a>
                                                <form action="{{ route('atividades-trabalhador.destroy', $atividade->id) }}" method="post" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta atividade?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
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

        const searchQuery = document.getElementById("searchQuery")

        const atividadeRow = document.querySelectorAll(".atividade-item")

        searchQuery.addEventListener("keyup", function(){

            const query = searchQuery.value.toLowerCase()

            atividadeRow.forEach(element => {
                const nome = element.querySelector(".nome").textContent.toLowerCase();
                const nomeFazenda = element.querySelector(".nome-fazenda").textContent.toLowerCase();
                const nomeCampo = element.querySelector(".nome-campo").textContent.toLowerCase();
                const tipo = element.querySelector(".tipo").textContent.toLowerCase();
 
                if (nome.includes(query) || nomeFazenda.includes(query) || nomeCampo.includes(query) || tipo.includes(query)) {

                    element.style.display=""
                    
                } else {
                    element.style.display="none"
                }
            });
        })
    })

</script>