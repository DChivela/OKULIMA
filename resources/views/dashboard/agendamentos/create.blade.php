@extends('layouts.dashboard')

@section('title', 'Criar Agendamento')

@section('content')

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">Criar Novo Agendamento</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('agendamentos.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="tarefa" class="form-label">Tarefa</label>
                                <input type="text" class="form-control" id="tarefa" name="tarefa" required placeholder="Digite a tarefa aqui...">
                            </div>
                            <div class="mb-3">
                                <label for="data_hora" class="form-label">Data e Hora</label>
                                <input type="datetime-local" class="form-control" id="data_hora" name="data_hora" required>
                            </div>
                            <div class="mb-3">
                                <label for="local" class="form-label">Local</label>
                                <input type="text" class="form-control" id="local" name="local">
                            </div>
                            <select name="trabalhador_id" id="trabalhador_id" class="form-control" required>
                                <option value="">Selecione um trabalhador</option>
                                @foreach ($trabalhadores as $trabalhador)
                                <option value="{{ $trabalhador->id }}">{{ $trabalhador->nome_trabalhador }}</option>
                                @endforeach
                            </select>


                            <div class="form-group">
                                <label>Fazenda</label>
                                <select class="form-control" name="fazendas_id" id="fazenda" required>
                                    <option value="" selected>Selecione a fazenda</option>
                                    @foreach($fazendas as $fazenda)
                                    <option value="{{ $fazenda->id }}">{{ $fazenda->nome_fazenda }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Campo de Cultivo</label>
                                <select class="form-control" name="campos_cultivo_id" id="campo_cultivo" required>
                                    <option value="" selected>Selecione o campo de cultivo</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="observacao" class="form-label">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- O link é utilizado para incluir o jQuery, uma biblioteca JavaScript popular
 que simplifica a manipulação do DOM, a realização de requisições AJAX,
entre outras operações em JavaScript. -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fazenda').on('change', function() {
            var fazendaId = $(this).val();

            // Limpa o dropdown de campos de cultivo
            $('#campo_cultivo').empty().append('<option value="" selected>Selecione o campo associado</option>');

            if (fazendaId) {
                $.ajax({
                    url: '/campos/' + fazendaId,
                    type: 'GET',
                    success: function(data) {
                        data.forEach(function(campo) {
                            $('#campo_cultivo').append(
                                `<option value="${campo.id}">${campo.nome_campo}</option>`
                            );
                        });
                    },
                    error: function() {
                        alert('Erro ao buscar os campos de cultivo.');
                    }
                });
            }
        });
    });
</script>
