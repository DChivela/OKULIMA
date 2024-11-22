@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                @include('msg.system')
                @include('msg.user')
                
                <div class="col-md-12">
                    <!-- Barra de Pesquisa -->
  <!--  <form action="{{ route('fazendas.index') }}" method="GET">
    <div class="input-group mb-4 mt-2">
        <input type="text" name="query" class="form-control" placeholder="Buscar fazenda ou campo de cultivo..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div> formulario que faz a busca na base de dados
</form>
-->
<div class="input-group mb-4 mt-2">
    <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por fazendas...">
</div>
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Lista de Fazendas</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="fazendasTable">
                                <thead >
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
                                    @forelse($fazendas as $fazenda)
                                        <tr class="fazenda-item">
                                            <td class="numero">{{ $fazenda->numero_fazenda }}</td>
                                            <td class="nome">{{ $fazenda->nome_fazenda }}</td>
                                            <td class="area">{{ $fazenda->area_fazenda }}</td>
                                            <td class="pais">{{ $fazenda->pais->nome }}</td>
                                            <td class="provincia">{{ $fazenda->provincia->nome }}</td>
                                            <td class="municipio">{{ $fazenda->municipio->nome }}</td>
                                            <td class="data-aquisicao">{{ $fazenda->data_aquisicao }}</td>
                                            <td class="data-exploracao">{{ $fazenda->data_exploracao }}</td>
                                            <td class="acoes">
                                                <a href="{{ route('fazendas.edit', $fazenda->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('fazendas.destroy', $fazenda->id) }}" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">Nenhuma fazenda ou campo de cultivo encontrado.</td>
                                        </tr>
                                    @endforelse
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

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){
        // Pegar o campo de input de busca
        const searchInput = document.getElementById('searchQuery');
        // Pegar todas as linhas de fazendas
        const fazendaRows = document.querySelectorAll('.fazenda-item');

        //Adicionar evento de digitacao ao campo de busca
        searchInput.addEventListener("keyup", function(){
            // Valor digitado pelo usuário sera aemazenado na variavel query
            const query = searchInput.value.toLowerCase();
            fazendaRows.forEach(function(row){
                const nomeFazenda = row.querySelector('.nome').textContent.toLowerCase();
                const areaFazenda = row.querySelector('.area').textContent.toLowerCase();
                const paisFazenda = row.querySelector('.pais').textContent.toLowerCase();
                const provinciaFazenda = row.querySelector('.provincia').textContent.toLowerCase();
                const municipioFazenda = row.querySelector('.municipio').textContent.toLowerCase();
                const dataAquisicaoFazenda = row.querySelector('.data-aquisicao').textContent.toLowerCase();
                const dataExploracaoFazenda = row.querySelector('.data-exploracao').textContent.toLowerCase();
            
            if(nomeFazenda.includes(query) || areaFazenda.includes(query) || paisFazenda.includes(query) ||provinciaFazenda.includes(query) ||municipioFazenda.includes(query) || dataAquisicaoFazenda.includes(query) || dataExploracaoFazenda.includes(query)) {
                row.style.display = '';
            } else{
                 row.style.display = 'none';
            }
           
       
        
        })

        })
    });

    </script>