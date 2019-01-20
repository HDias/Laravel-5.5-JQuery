@extends('layouts.app')

@section('modulejs')
    <script src="{!! asset('js/acl/role/form.js') !!}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <h5 class="card-header"><strong>Editar</strong> Usuário</h5>
            <div class="card-body">

                <form id="form-user" action="{{ route('user.update', $user->id)}}" method="POST" novalidate="novalidate">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="role">Perfil</label>
                            <nut-select :data-alert="{{ json_encode($errors->has('roles')) }}"
                                        :data-options="{{ json_encode($roles) }}"
                                        :data-placeholder="''"
                                        :data-is-multiple="true"
                                        name="roles"
                                        :data-selected="{{ empty(old('roles')) == false ? (int)old('roles') : json_encode($selectedRoles)  }}">
                            </nut-select>
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
                                   value="{{ empty(old('name')) == false ? old('name') : $user->name }}">
                            @include('alerts.input', ['name' => 'name'])
                        </div>

                        <div class="col-md-5">
                            <label for="cpf">CPF</label>
                            <input id="cpf"
                                   name="cpf"
                                   placeholder="000.000.000-00"
                                   class=" form-control {{ isInvalid($errors, 'name') }} "
                                   value="{{ empty(old('cpf')) == false ? old('cpf') : $user->cpf  }}"
                                   type="text"
                                   v-mask="'###.###.###-##'">
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
                                   value="{{ empty(old('email')) == false ? old('email') : $user->email }}">
                            @include('alerts.input', ['name' => 'email'])
                        </div>
                        <div class="col-md-4">
                            <label for="dt_birth">Data de nascimento</label>
                            <input type="text"
                                   name="dt_birth"
                                   class=" form-control {{ isInvalid($errors, 'dt_birth') }} "
                                   value="{{ empty(old('dt_birth')) == false ? old('dt_birth') : $user->dt_birth ? $user->dt_birth->format('d/m/Y') : '' }}"
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
                                        :data-selected="{{ empty(old('sexo')) == false ? old('sexo') : (int)$user->sexo}}"
                                        :data-is-multiple="false"
                                        name="sexo"></nut-select>
                            @include('alerts.input', ['name' => 'sexo'])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="password">Senha</label>
                            <input type="password"
                                   name="password"
                                   class="form-control {{ isInvalid($errors, 'name') }}"
                                   id="password"
                                   placeholder="Mínimo 6 caracteres">
                            @include('alerts.input', ['name' => 'password'])
                        </div>
                        <div class="col">
                            <label for="email">Repita a Senha</label>
                            <input type="password"
                                   name="password_confirmation"
                                   placeholder="Mínimo 6 caracteres"
                                   class="form-control {{ isInvalid($errors, 'email') }}"
                                   id="email"
                                   value="{{ old('password_confirmation') }}">
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <div class="button-group pull-right">
                    <button type="submit" form="form-user" class="btn btn-primary btn-right">{{ trans('forms.button_update') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection