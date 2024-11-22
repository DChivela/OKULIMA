@extends('layouts.dashboard')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')

@section('content')


<!--<form action="{{ route('trabalhador.index') }}" method="GET">
    <div class="input-group mb-4 mt-2">
        <input type="text" name="query" class="form-control" placeholder="Buscar Trabalhadores..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>-->

<div class="input-group mb-4 mt-2">
    <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por trabalhadores...">
</div>
<div class="card">


    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
                      <!-- Barra de Pesquisa -->
    
        <table class="table m-0">
            <thead>
                <tr>
                    <th>Número de profissão</th>
                    <th>Nome da profissão</th>
                    <th>Nome da trabalhador</th>
                    <th>Custo por Hora</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trabalhadores as $trabalhador)
                <tr class="trabalhador-item">
                    <td class="numero">{{ $trabalhador->numero_profissao }}</td>
                    <td class="nome-pro">{{ $trabalhador->nome_profissao }}</td>
                    <td class="nome-trabalhador">{{ $trabalhador->nome_trabalhador }}</td>
                    <td class="custo">{{ $trabalhador->custo_trabalho }} AOA</td>
                    <td>
                        <a href="{{ route('EditTrabalhador', $trabalhador->id) }}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('DeleteTrabalhador', $trabalhador->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este trabalhador?');"><i class="bi bi-trash"> </i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function(){
         
        //Aqui pegar o input de pesquisa
        const searchQuery = document.getElementById('searchQuery');
        //Aqui pegar as linhas dos trabalhadores
        const trabalhadorRows = document.querySelectorAll('.trabalhador-item');

        //evento de digitaçao para campo de pesquisa
        searchQuery.addEventListener("keyup", function(){

            //variavel que vai pegar oque o usuario esta digitando
            const query = searchQuery.value.toLowerCase();

            trabalhadorRows.forEach(element => {
                const numero = element.querySelector(".numero").textContent.toLowerCase();
                const nomePro = element.querySelector(".nome-pro").textContent.toLowerCase();
                const nomeTrabalhador = element.querySelector(".nome-trabalhador").textContent.toLowerCase();
                const custo = element.querySelector(".custo").textContent.toLowerCase();

                if (numero.includes(query) || nomePro.includes(query) || nomeTrabalhador.includes(query) || custo.includes(query)) {
                    element.style.display="";
                }else{
                    element.style.display="none"
                }
                
            });

        });
      });

</script>