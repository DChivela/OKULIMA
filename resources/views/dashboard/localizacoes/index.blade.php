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
                            <div class="card-title">Registo de Localizações</div>
                        </div>
                        <div class="content-wrapper mt-5">
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <form action="{{ route('localizacoes.storePais') }}" method="post">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <span>Registar País</span>
                                                            <div class="form-group">
                                                                <label>Nome do País</label>
                                                                <input type="text" class="form-control" name="nome" placeholder="Ex: Angola" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary form-control">Registar País</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-4">
                                            <form action="{{ route('localizacoes.storeProvincia') }}" method="post">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <span>Registar Província</span>
                                                            <div class="form-group">
                                                                <label>Nome da Província</label>
                                                                <input type="text" class="form-control" name="nome" placeholder="Ex: Luanda" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Associada a qual país</label>
                                                                <select class="form-control" name="pais_id" required>
                                                                    @foreach($paises as $pais)
                                                                        <option value="{{ $pais->id }}">{{ $pais->nome }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary form-control">Registar Província</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-4">
                                            <form action="{{ route('localizacoes.storeMunicipio') }}" method="post">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <span>Registar Município</span>
                                                            <div class="form-group">
                                                                <label>Nome do Município</label>
                                                                <input type="text" class="form-control" name="nome" placeholder="Ex: Belas" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Associado a que província</label>
                                                                <select class="form-control" name="provincia_id" required>
                                                                    @foreach($provincias as $provincia)
                                                                        <option value="{{ $provincia->id }}">{{ $provincia->nome }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary form-control">Registar Município</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="input-group mb-4 mt-2">
                     <input type="text" id="searchQuery" class="form-control" placeholder="Buscar por localizações...">
                 </div>
                            </section>
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Consulta de Localizações</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="card-body">
                                                            <table id="pais" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>País</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($paises as $pais)
                                                                        <tr class="pais-item">
                                                                            <td class="pais-nome">{{ $pais->nome }}</td>
                                                                            <td>
                                                                                <form action="{{ route('localizacoes.destroyPais', $pais->id) }}" method="post">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>País</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="card-body">
                                                            <table id="provincia" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Província</th>
                                                                        <th>País Associado</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($provincias as $provincia)
                                                                        <tr class="provincia-item">
                                                                            <td class="provincia-nome">{{ $provincia->nome }}</td>
                                                                            <td class="provincia-pais">{{ $provincia->pais->nome }}</td>
                                                                        
                                                                           
                                                         
                                                                            <td>
                                                                                <form action="{{ route('localizacoes.destroyProvincia', $provincia->id) }}" method="post">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Província</th>
                                                                        <th>País Associado</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="card-body">
                                                            <table id="municipio" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Município</th>
                                                                        <th>Província Associada</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($municipios as $municipio)
                                                                        <tr class="municipio-item">
                                                                            <td class="nome-municipio">{{ $municipio->nome }}</td>
                                                                            <td class="nome-provincia">{{ $municipio->provincia->nome }}</td>
                                                                            <td>
                                                                                <form action="{{ route('localizacoes.destroyMunicipio', $municipio->id) }}" method="post">
                                                                                    @csrf
                                                                                    @method('delete')
                                                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Município</th>
                                                                        <th>Província Associada</th>
                                                                        <th>Eliminar</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
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

        const paisRow = document.querySelectorAll(".pais-item")
        const provinciaRow = document.querySelectorAll(".provincia-item")
        const municipioRow = document.querySelectorAll(".municipio-item")

        searchQuery.addEventListener("keyup", function(){

            const query = searchQuery.value.toLowerCase();

            paisRow.forEach(element => {
                const nomePais = element.querySelector(".pais-nome").textContent.toLowerCase();

                
                if (nomePais.includes(query)) {
                    element.style.display=""
                } else {
                  element.style.display="none"  
                }
            });

            provinciaRow.forEach(element => {
                const provinciaNome = element.querySelector(".provincia-nome").textContent.toLowerCase();
                const provinciaPais = element.querySelector(".provincia-pais").textContent.toLowerCase();

                if (provinciaNome.includes(query) || provinciaPais.includes(query) ) {
                    element.style.display=""
                } else {
                    element.style.display="none" 
                }

                
            });
      
            // Mover a declaração de 'found' para fora do loop
            
            municipioRow.forEach(element => {
                const nomeMunicipio = element.querySelector(".nome-municipio").textContent.toLowerCase();
                const nomeProvincia = element.querySelector(".nome-provincia").textContent.toLowerCase();

                if (nomeMunicipio.includes(query) || nomeProvincia.includes(query)) {
                    element.style.display = "";
                
                } else { 
                    element.style.display = "none";
                }
            });

          
        })
    })
    </script>