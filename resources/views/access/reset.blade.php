@extends('layouts.access')
@section('title', 'Okulima - Nova senha')

@section('content')
<div class="card">
    @include('msg.system')
    @include('msg.user')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Redefinir Senha</p>

        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Digite o seu e-mail" name="email" value="{{ old('email') }}" required>
                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Sua nova senha" name="password" required>
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirme sua nova senha" name="password_confirmation" required>
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Redefinir Senha</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
