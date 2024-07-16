@extends('layouts.access')
@section('title', 'Okulima - Sistema de Gestão Agrícola Inteligente')
@section('content')

<div class="card">
    @include('msg.system')
    @include('msg.user')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Insira suas credencias</p>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Digite o seu e-mail" name="email" value="{{ old('email') }}">
                <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Sua password" name="password">
                <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Guardar dados</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Aceder</button>
                    </div>
                </div>
            </div>
        </form>
        <p class="mb-1"> <a href="{{ route('password.request') }}">Esqueci a senha</a> </p>
        <p class="mb-0"> <a href="{{ route('register') }}" class="text-center"> Criar uma conta </a> </p>
    </div>
</div>


@endsection

