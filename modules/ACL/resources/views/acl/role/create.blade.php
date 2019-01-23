@extends('layouts.app')

@section('modulejs')
    <script src="{!! asset('js/acl/role/form.js') !!}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <h5 class="card-header"><strong>Novo</strong> Perfil</h5>
            <div class="card-body">

                <form id="form-role" action="{{ route('acl.role.store')}}" method="POST" novalidate="novalidate">
                    {{ csrf_field() }}

                    <div class="row mb-4">
                        <div class="col">
                            <label for="dt_creation">Nome</label>
                            <nut-autocomplete
                                    data-url="{{ route('acl.role.autocomplete') }}"
                                    :required="true"
                                    data-placeholder="Nome para Leitura"
                                    name="name"
                                    input-class="form-control {{ isInvalid($errors, 'name') }}"
                                    value="{{ old('name') }}"></nut-autocomplete>

                            @include('alerts.input', ['name' => 'name'])
                        </div>
                    </div>

                    @include('acl.role.permissions')
                </form>
            </div>

            <div class="card-footer">
                <div class="button-group pull-right">
                    <button type="submit" form="form-role"
                            class="btn btn-primary btn-right ">{{ trans('forms.button_cad') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection