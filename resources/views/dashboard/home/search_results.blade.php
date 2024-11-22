@extends('layouts.app')  {{-- Certifique-se de que o layout está correto --}}

@section('content')
    <div class="container">
        <h1>Resultados da Pesquisa para "{{ $query }}"</h1>

        @if(isset($results) && count($results) > 0)
            <div class="results">
                @foreach($results as $result)
                    <div class="result-item">
                        <h2>{{ ucfirst(str_replace('_', ' ', $result['table'])) }}</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    @if($result['table'] === 'atividades_trabalhador')
                                        <th>Data</th>
                                        <th>Trabalhador</th>
                                        <th>Fazenda</th>
                                        <th>Campo</th>
                                        <th>Tipo de Atividade</th>
                                    @elseif($result['table'] === 'atividade_colheitas')
                                        <th>Data</th>
                                        <th>Fazenda</th>
                                        <th>Campo</th>
                                    @elseif($result['table'] === 'paises')
                                        <th>ID</th>
                                        <th>Nome do País</th>
                                    @elseif($result['table'] === 'provincias')
                                        <th>ID</th>
                                        <th>Nome da Província</th>
                                        <th>Nome do País</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($result['table'] === 'atividades_trabalhador')
                                        <td>{{ $result['data']->data }}</td>
                                        <td>{{ $result['data']->nome_trabalhador }}</td>
                                        <td>{{ $result['data']->nome_fazenda }}</td>
                                        <td>{{ $result['data']->nome_campo }}</td>
                                        <td>{{ $result['data']->tipo_atividade }}</td>
                                    @elseif($result['table'] === 'atividade_colheitas')
                                        <td>{{ $result['data']->data }}</td>
                                        <td>{{ $result['data']->nome_fazenda }}</td>
                                        <td>{{ $result['data']->nome_campo }}</td>
                                    @elseif($result['table'] === 'paises')
                                        <td>{{ $result['data']->id }}</td>
                                        <td>{{ $result['data']->nome }}</td>
                                    @elseif($result['table'] === 'provincias')
                                        <td>{{ $result['data']->id }}</td>
                                        <td>{{ $result['data']->nome }}</td>
                                        <td>{{ $result['data']->nome_pais }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @else
            <p>Nenhum resultado encontrado para "{{ $query }}".</p>
        @endif
    </div>
@endsection
