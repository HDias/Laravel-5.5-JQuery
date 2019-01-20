@extends('layouts.app')

@section('modulejs')
    <script src="{!! asset('js/acl/role/form.js') !!}"></script>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="alert alert-primary alert-dismissible fade show rounded-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="alert-heading">Informações!</h5>
            <p>A senha para o usuário cadastrado é <strong>123456.</strong> Quando fizer o primeiro acesso vai pedir alteraçaõ de senha.</p>
        </div>

        <div class="card mb-4 card-shadow-6">
            <h5 class="card-header"><strong>Novo</strong> Usuário</h5>
            <div class="card-body">

                <form id="form-user" action="{{ route('user.store')}}" method="POST" novalidate="novalidate">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="role">Perfil</label>
                            <nut-select :data-alert="{{ json_encode($errors->has('roles')) }}"
                                        :data-options="{{ json_encode($roles) }}"
                                        :data-placeholder="''"
                                        :data-is-multiple="true"
                                        name="roles"></nut-select>
                            @include('alerts.input', ['name' => 'roles'])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <label for="name">Nome Completo</label>
                            <input type="text"
                                   name="name"
                                   class="form-control {{ isInvalid($errors, 'name') }}"
                                   id="name"
                                   placeholder="Nome do Usuário"
                                   value="{{ old('name') }}">
                            @include('alerts.input', ['name' => 'name'])
                        </div>

                        <div class="col-md-5">
                            <label for="cpf">CPF</label>
                            <input id="cpf"
                                   name="cpf"
                                   placeholder="000.000.000-00"
                                   class=" form-control {{ isInvalid($errors, 'name') }} "
                                   value="{{ old('cpf')  }}"
                                   type="text"
                                   v-mask="'###.###.###-##'"/>
                            @include('alerts.input', ['name' => 'cpf'])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="email">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control {{ isInvalid($errors, 'email') }}"
                                   id="email"
                                   placeholder="email@email.com"
                                   value="{{ old('email') }}">
                            @include('alerts.input', ['name' => 'email'])
                        </div>

                        <div class="col-md-4">
                            <label for="dt_birth">Data de nascimento</label>
                            <input type="text"
                                   name="dt_birth"
                                   class=" form-control {{ isInvalid($errors, 'dt_birth') }} "
                                   value="{{ old('dt_birth') }}"
                                   placeholder="Ex: 19/04/1977"
                                   id="dt_birth"
                                   v-mask="'##/##/####'">
                            @include('alerts.input', ['name' => 'dt_birth'])
                        </div>

                        <div class="col-md-4">
                            <label for="sexo">Sexo</label>

                            <nut-select :data-alert="{{ json_encode($errors->has('sexo')) }}"
                                        :data-options="{{ json_encode(getOptions('sexo')) }}"
                                        :data-placeholder="''"
                                        :data-selected="{{ empty(old('sexo')) == false ? (int)old('sexo') : 0 }}"
                                        :data-is-multiple="false"
                                        name="sexo"></nut-select>
                            @include('alerts.input', ['name' => 'sexo'])
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <div class="button-group pull-right">
                    <button type="submit" form="form-user"
                            class="btn btn-primary btn-right ">{{ trans('forms.button_cad') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection