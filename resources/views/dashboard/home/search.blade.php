@extends('layouts.dashboard')
@section('title', 'Okulima - Pesquisa')

@section('content')
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-text pre {
            white-space: pre-wrap;
            word-break: break-all;
        }

        h4 {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
    <div class="app-content">
        <div class="container-fluid">
            @include('msg.system')
            @include('msg.user')

            <div class="row pt-5">
                <div class="col-12">
                    <form id="search-form" class="mb-4">
                        <div class="input-group">
                            <input type="text" id="search-query" class="form-control" placeholder="Pesquisar...">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div id="search-results"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const query = document.getElementById('search-query').value;
            fetch(`/search-results?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    const resultsContainer = document.getElementById('search-results');
                    resultsContainer.innerHTML = '';

                    if (data.length === 0) {
                        resultsContainer.innerHTML = '<p>Nenhum resultado encontrado.</p>';
                        return;
                    }

                    let currentTable = '';
                    data.forEach(result => {
                        if (result.table !== currentTable) {
                            currentTable = result.table;
                            const tableHeader = document.createElement('h4');
                            tableHeader.innerText = `Resultados encontrados em: ${currentTable}`;
                            resultsContainer.appendChild(tableHeader);
                        }

                        const card = document.createElement('div');
                        card.classList.add('card', 'mb-2');
                        card.innerHTML = `
                            <div class="card-body">
                                <pre class="card-text">${JSON.stringify(result.data, null, 2)}</pre>
                            </div>
                        `;
                        resultsContainer.appendChild(card);
                    });
                })
                .catch(error => console.error('Erro:', error));
        });
    </script>
@endsection
