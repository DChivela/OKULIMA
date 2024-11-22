@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                <div class="col-md-12">
                                    <!--Baraa de Pesquisa-->
                        <!--            <form action="{{ route('equipamento.index') }}" method="GET">
    <div class="input-group mb-4 mt-2">
        <input type="text" name="query" class="form-control" placeholder="Buscar por um equipamento..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div> formulario que busca na base de dados
</form>-->
<!-- Barra de Pesquisa -->
<div class="input-group mb-4 mt-2">
    <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por um equipamento no front...">
</div>

                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Lista de Equipamentos</div>
                        </div>
                        <div class="card-body">
    <table class="table m-0" id="equipamentosTable">
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
            <tr class="equipamento-item">
                <td class="numero-equipamento">{{ $equipamento->numero_equipamento }}</td>
                <td class="nome-equipamento">{{ $equipamento->nome_equipamento }}</td>
                <td class="data-aquisicao">{{ $equipamento->data_aquisicao }}</td>
                <td class="valor-aquisicao">{{ $equipamento->valor_aquisicao }}</td>
                <td class="vida-util">{{ $equipamento->vida_util }}</td>
                <td class="custo-hora">{{ $equipamento->custo_hora }}</td>
                <td>
                    <a href="{{ route('EditEquipamento', $equipamento->id) }}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('DeleteEquipamento', $equipamento->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este equipamento?');"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
                <div id="result"></div>
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
    document.addEventListener("DOMContentLoaded", function() {
        // Pegar o campo de input de busca
        const searchInput = document.getElementById('searchQuery');
        // Pegar todas as linhas de equipamentos
        const equipamentoRows = document.querySelectorAll('.equipamento-item');

        // Adicionar evento de digitação ao campo de busca
        searchInput.addEventListener('keyup', function() {
            // Valor digitado pelo usuário
            const query = searchInput.value.toLowerCase();

            // Loop em todas as linhas de equipamentos
            equipamentoRows.forEach(function(row) {
                // Pegar o conteúdo das colunas de número e nome e data 
                const numeroEquipamento = row.querySelector('.numero-equipamento').textContent.toLowerCase();
                const nomeEquipamento = row.querySelector('.nome-equipamento').textContent.toLowerCase();
                const dataAquisicao = row.querySelector(".data-aquisicao").textContent.toLowerCase();
                const valorAquisicao = row.querySelector(".valor-aquisicao").textContent.toLowerCase();
                const vidaUtil = row.querySelector(".vida-util").textContent.toLowerCase();
                const custoHora = row.querySelector(".custo-hora").textContent.toLowerCase();

                // Verificar se o texto digitado corresponde ao nome ou número
                if (numeroEquipamento.includes(query) || nomeEquipamento.includes(query) || dataAquisicao.includes(query) 
                || valorAquisicao.includes(query) || vidaUtil.includes(query) || custoHora.includes(query)) {
                    // Mostrar a linha se corresponder
                    row.style.display = '';
                } else  {
                    // Esconder a linha se não corresponder
                  row.style.display = 'none';
                    // Verificar se todas as linhas estão ocultas e mostrar/ocultar mensagem
                    


                }
            });
        });
    });
</script>
