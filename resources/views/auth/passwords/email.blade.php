@extends('layouts.base')

@section('content')
<nav class="navbar navbar-expand-lg navbar-blue bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand d-none d-sm-block" href="{{ route('dashboard.index') }}">
        <img class="img-logo" src="/img/logo.png">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <i class="fa fa-bars text-white" aria-hidden="true"></i>
    </button>
</nav>
<div class="container pt-5">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Redefinição de Senha</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">E-Mail</label>

                            <div class="col-lg-6">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Link de Redefinição de Senha
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
