@extends('layouts.app')

@section('modulejs')
    <script src="{!! asset('js/acl/role/form.js') !!}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <h5 class="card-header"><strong>Editar</strong> Opção</h5>
            <div class="card-body">

                <form id="form-role" action="{{ route('select.option.update', $option->id)}}" method="POST"
                      novalidate="novalidate">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="row mb-4">
                        <nut-options-fields :data-description-value="{{ json_encode($option->description) }}"></nut-options-fields>

                        <div class="col-md-12">
                            @include('alerts.input', ['name' => 'slug'])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10">
                            <label for="label">Label</label>
                            <input id="label" type="text" name="label"
                                   class="form-control {{ isInvalid($errors, 'label') }}"
                                   required="required"
                                   value="{{ empty(old('label')) == false ? old('label') : $option->label }}">
                            @include('alerts.input', ['name' => 'label'])
                        </div>

                        <div class="col-md-2">
                            <label for="order">Ordem</label>
                            <input id="order" type="number" name="order"
                                   class="form-control {{ isInvalid($errors, 'order') }}"
                                   required="required"
                                   value="{{ empty(old('order')) == false ? old('order') : $option->order }}">
                            @include('alerts.input', ['name' => 'order'])
                        </div>

                        <div class="col-md-10">
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-footer">
                <div class="button-group pull-right">
                    <button type="submit" form="form-role"
                            class="btn btn-primary btn-right ">{{ trans('forms.button_update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection