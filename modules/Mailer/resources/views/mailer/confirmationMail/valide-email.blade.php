@extends('layouts.base-login-cad')

@section('content')

    @include('layouts.nav-cad')

    <div class="row h-100 card-ctn full-width-image tf-form-ctn">

        <div class="col-12 text-center text-white ctn-top-text ctn-img-logo">
            <img class="img-logo" src="{{ asset('img/logo.png') }}" alt="Logo Troca Fácil Online">
        </div>
        <div class="card card-block w-25 d-flex m-auto col-lg-6 col-md-6 col-8">
            <div class="card-body pl-0 pr-0">
                <p>Enviamo um email de confirmação para <span class="badge badge-red-200 ">{{ \Auth::user()->email }}</span>!</p>
                <p>Clique no link de confirmação para continuar sua forma mais fácil de fazer trocas de veículos.</p>
            </div>
        </div>
    </div>
@endsection
