@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <div class="card-header">

                <h5 class="title d-inline"><strong>Lista</strong> de Usuários</h5>

                <div class="pull-right">

                    @shield('user.create')
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> {{ trans('forms.button_new') }}
                        </a>
                    @endshield
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Perfil</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $data)
                            <tr class="{{ deletedAt($data->deleted_at, 1) }}">
                                <td>{!! getId($data->id, $loop->iteration) !!}</td>
                                <td>{!! $data->name !!}</td>
                                <td>
                                    @forelse($data->roles as $role)
                                        <span class="badge badge-info p-2">{!! $role->name !!}</span>
                                    @empty
                                        <span class="badge badge-danger">Nenhum Perfil Cadastrado</span>
                                    @endforelse
                                </td>
                                @if(!deletedAt($data->deleted_at, 2))
                                <td class="text-center" nowrap>

                                    @shield('user.edit')
                                        <a href="{{ route('user.edit', ['id' => $data->id]) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endshield

                                    @shield('user.destroy')
                                        <nut-trash-btn href="{{ route('user.destroy', $data->id) }}"
                                                       data-id="{{ $data->id }}">
                                        </nut-trash-btn>
                                    @endshield

                                </td>
                                @elseif (deletedAt($data->deleted_at, 1))
                                    <td class="text-center">
                                        @include('layouts.btnRestore', [
                                            'route' => route('user.restore', ['id' => $data->id]),
                                            'model' => 'Usuário'
                                        ])
                                    </td>

                                @endif
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">{{ trans('list.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection