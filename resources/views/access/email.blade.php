@extends('layouts.access')
@section('title', 'Okulima - Recuperar senha')

@section('content')
<div class="card">
    @include('msg.system')
    @include('msg.user')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Recuperar Senha</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Digite o seu e-mail" name="email" value="{{ old('email') }}" required>
                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Enviar link de recuperação</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
