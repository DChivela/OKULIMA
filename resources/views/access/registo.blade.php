@extends('layouts.access')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')
@section('content')

<div class="card">
    @include('msg.system');
    @include('msg.user');
    <div class="card-body login-card-body">
        <p class="login-box-msg">Preencha os campos abaixo</p>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Seu nome completo" name="nome_utilizador" value="{{ old('nome_utilizador') }}">
                <div class="input-group-text"> <span class="bi bi-person"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Sua senha" name="senha_utilizador">
                <div class="input-group-text"> <span class="bi bi-key"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirme sua senha" name="senha_utilizador_confirmation">
                <div class="input-group-text"> <span class="bi bi-key"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Seu e-mail" name="email_utilizador" value="{{ old('email_utilizador') }}">
                <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Seu Telefone" name="telefone_utilizador" value="{{ old('telefone_utilizador') }}">
                <div class="input-group-text"> <span class="bi bi-phone"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="date" class="form-control" placeholder="Data de Nascimento" name="idade_utilizador" value="{{ old('idade_utilizador') }}">
                <div class="input-group-text"> <span class="bi bi-calendar"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Numero de Bilhete" name="bilhete_utilizador" value="{{ old('bilhete_utilizador') }}">
                <div class="input-group-text"> <span class="bi bi-card-checklist"></span> </div>
            </div>
            <div class="input-group mb-3">
                <select name="nivel_utilizador" id="nivel_utilizador" class="form-control">
                    <option value="1" {{ old('nivel_utilizador') == 1 ? 'selected' : '' }}>Administrador</option>
                    <option value="2" {{ old('nivel_utilizador') == 2 ? 'selected' : '' }}>Trabalhador</option>
                </select>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault" {{ old('terms') ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">Aceito os <a href="#">termos!</a></label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Registar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

