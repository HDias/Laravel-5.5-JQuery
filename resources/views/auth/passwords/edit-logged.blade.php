@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Dados</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="form-user-edit-logged" action="{{ route('user.update_logged')}}" method="PUT"
                              novalidate="novalidate">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col">
                                    <label for="name">Nome Completo</label>
                                    <input type="text"
                                           name="name"
                                           class="form-control {{ isInvalid($errors, 'name') }}"
                                           id="name"
                                           placeholder="Nome do Usuário"
                                           value="{{ old('name') }}">
                                    @include('alerts.input', ['name' => 'name'])
                                </div>
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control {{ isInvalid($errors, 'email') }}"
                                           id="email"
                                           placeholder="email@email.com"
                                           value="{{ old('email') }}">
                                    @include('alerts.input', ['name' => 'email'])
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="button-group pull-right">
                            <button type="submit" form="form-user-edit-logged"
                                    class="btn btn-primary btn-right ">{{ trans('forms.button_cad') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @include('auth.passwords.change-password');
        </div>
    </div>
@endsection
