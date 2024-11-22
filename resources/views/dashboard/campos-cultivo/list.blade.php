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
                    <form action="{{ route('campos-cultivo.index') }}" method="GET">
   <!-- <div class="input-group mb-4 mt-2">
        <input type="text" name="query" class="form-control" placeholder="Buscar campo de cultivo..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>-->

<div class="input-group mb-4 mt-2">
    <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por campos de cultivo...">
</div>
<div class="card">
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
                                        <tr class="campo-item">
                                            <td class="numero">{{ $campo->numero_campo }}</td>
                                            <td class="nome">{{ $campo->nome_campo }}</td>
                                            <td class="area">{{ $campo->area_campo }}</td>
                                            <td class="nome-fazenda">{{ $campo->fazenda->nome_fazenda }}</td>
                                            <td>{{ $campo->data_exploracao }}</td>
                                            <td class="sistema">{{ $campo->sistema_irrigacao }}</td>
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
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){

    const searchQuery = document.getElementById("searchQuery")

    const campoRow = document.querySelectorAll(".campo-item")
    
    searchQuery.addEventListener("keyup", function(){

        const query = searchQuery.value.toLowerCase();

        campoRow.forEach(element => {
            
            const numero = element.querySelector(".numero").textContent.toLowerCase();
            const nome = element.querySelector(".nome").textContent.toLowerCase();
            const area = element.querySelector(".area").textContent.toLowerCase();
            const nomeFazenda = element.querySelector(".nome-fazenda").textContent.toLowerCase();
            const sistema = element.querySelector(".sistema").textContent.toLowerCase();
            if (numero.includes(query) || nome.includes(query) || area.includes(query) || nomeFazenda.includes(query) || sistema.includes(query)) {
                element.style.display=""
            } else {
                element.style.display="none"
            }
        });
    })


  })

</script>