@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <h5 class="card-header"><strong>Editar</strong> Editar Permissão</h5>
            <div class="card-body">

                <label>
                    {{--{!! Form::checkbox('permissions_id[]', $id, isset($role) ? in_array($id, $role->permissions()->pluck('id')->toArray()) : false, [--}}
                    {{--'class' => 'son ' . $values['class']--}}
                    {{--]) !!} {!! $values['name'] !!}--}}
                </label>
                <form id="form-permission" action="{{ route('acl.permission.update', ['id' => $permission->id])}}"
                      method="POST"
                      novalidate="novalidate">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col">
                            <label for="readable_name">Label (Nome para Leitura)</label>
                            <nut-autocomplete
                                    data-url="{{ route('acl.permission.label_autocomplete') }}"
                                    :required="true"
                                    data-placeholder="Nome para Leitura"
                                    name="readable_name"
                                    input-class="form-control {{ isInvalid($errors, 'readable_name') }}"
                                    value="{{ $permission->readable_name }}"></nut-autocomplete>

                            @include('alerts.input', ['name' => 'readable_name'])
                        </div>

                        <div class="col">
                            <label for="name">Nome (Permissão)</label>
                            <nut-autocomplete
                                    data-url="{{ route('acl.permission.name_autocomplete') }}"
                                    :required="true"
                                    data-placeholder="Permissão (Controller.action)"
                                    name="name"
                                    input-class="form-control {{ isInvalid($errors, 'name') }}"
                                    value="{{ $permission->name }}"></nut-autocomplete>

                            @include('alerts.input', ['name' => 'name'])
                        </div>

                    </div>
                </form>

            </div>
            <div class="card-footer">
                <div class="button-group pull-right">
                    <button type="submit" form="form-permission" class="btn btn-primary btn-right ">Atualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection