@extends('layouts.base-login')

@section('content')

    <div class="row h-100 container-login100">

        <div class="d-flex col-lg-3 col-md-4 col-9">
            <div class="card m-auto">
                {{--<div class="text-center">--}}
                {{--<i class="fas fa-user-lock"></i>--}}
                {{--</div>--}}
                <div class="card-body">
                    <h3 class="card-title login100-form-title text-center py-4 mb-5"><strong>{{ config('app.name') }}</strong></h3>

                    <form class="login-form" method="POST" action="{{ route('login') }}" novalidate="novalidate">
                        {{ csrf_field() }}

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <div class="wrap-input100 mb-0">
                                    <input class="full-border-none input100 {{ $errors->has('cpf') ? ' border-danger' : '' }}"
                                           type="text" name="cpf" placeholder="CPF" autofocus autocomplete="off">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                    <i class="fas fa-fingerprint"></i>
                                </span>
                                </div>
                                @include('alerts.input', ['name' => 'cpf'])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="wrap-input100">
                                    <input class="full-border-none input100 {{ $errors->has('password') ? ' border-danger' : '' }}"
                                           type="password" name="password" placeholder="Senha">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                    <i class="fas fa-lock"></i>
                                </span>
                                </div>
                            </div>

                            @include('alerts.input', ['name' => 'password'])
                        </div>

                        <div class="container-login100-form-btn mt-4">
                            <button class="login100-form-btn" type="submit">
                                Login
                            </button>
                        </div>

                        <div class="row justify-content-center mt-2 mb-5">
                            <small>
                                <a class="login-link red-100-theme" href="{{ route('password.request') }}">
                                    Esqueceu a Senha?
                                </a>
                            </small>
                        </div>

                    </form>
                </div>

                <div class="card-footer text-muted text-center">
                    <small>
                        <a class="login-link red-100-theme" href="{{ route('password.request') }}">
                            Crie sua Conta
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>

@endsection
