@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Vincular Permissão em Usuário</h1>
        </div>
    </div>
    {!! Form::open([
        'action' => [
            'ACL\PermissionUserController@store',
            request('id', $user->id)
        ],
        'class' => 'form-horizontal',
        'data-toggle' => 'validator'
    ]) !!}
    <fieldset>
        @foreach($permissions as $title => $permission)
            @if ($loop->first)
                <div class="row">
                    @endif
                    <div class="col-md-2">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                {!! str_replace('_', ' ', $title) !!}
                            </div>
                            <div class="panel-body">
                                @foreach($permission as $id => $values)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    {!! Form::checkbox('permissions_id[]', $id, in_array($id, $user->getAllPermissions()->pluck('id')->toArray()), [
                                                        'disabled' => in_array($id, $user->getRolesPermissions()->pluck('id')->toArray())
                                                    ]) !!} {!! $values['name'] !!}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if (($loop->iteration % 6) == 0)
                </div>
                <div class="row">
                    @endif
                    @if ($loop->last)
                </div>
            @endif
        @endforeach
        <div class="form-group">
            <div class="col-md-12">
                {!! Form::submit('Vincular', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}
@endsection