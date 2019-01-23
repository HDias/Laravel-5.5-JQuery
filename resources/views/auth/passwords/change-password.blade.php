@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alterar Senha</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="form-user-change-password" action="{{ route('user.update_password')}}" method="POST"
                              novalidate="novalidate">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col">
                                    <label for="password">Senha</label>
                                    <input type="password"
                                           name="password"
                                           class="form-control {{ isInvalid($errors, 'password') }}"
                                           id="password"
                                           placeholder="Mínimo 6 caracteres">
                                    @include('alerts.input', ['name' => 'password'])
                                </div>
                                <div class="col">
                                    <label for="password_confirmation">Repita a Senha</label>
                                    <input type="password"
                                           name="password_confirmation"
                                           placeholder="Mínimo 6 caracteres"
                                           class="form-control {{ isInvalid($errors, 'password_confirmation') }}"
                                           id="password_confirmation"
                                           value="{{ old('password_confirmation') }}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="button-group pull-right">
                            <button type="submit" form="form-user-change-password"
                                    class="btn btn-primary btn-right ">{{ trans('forms.button_update') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
