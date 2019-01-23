@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <div class="card-header">
                <h5 class="title d-inline"><strong>Lista</strong> de Perfis</h5>

                <div class="pull-right">

                    @shield('acl.role.create')
                        <a href="{{ route('acl.role.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> {{ trans('forms.button_new') }}
                        </a>
                    @endshield
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Descrição</th>
                            <th scope="col" class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($roles as $td)
                            <tr>
                                <td>{!! getId($td->id, $loop->iteration) !!}</td>
                                <td>{!! $td->name !!}</td>
                                <td>{!! $td->description !!}</td>

                                <td nowrap class="text-center">
                                    {{-- Role Desenvolvedor e suporte não pode editar --}}

                                    @php
                                        $roles = [config('defender.superuser_role'), config('defender.restore_role')]
                                    @endphp

                                    @if(! in_array($td->name, $roles))
                                        @shield('acl.role.edit')
                                            <a href="{{ route('acl.role.edit', $td->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endshield

                                        @shield('acl.role.destroy')
                                            @include('layouts.trashBtn', ['route' => route('acl.role.destroy', $td->id)])
                                        @endshield

                                        @shield('acl.permission.index')
                                            <b-btn href="{{  route('acl.permission.index', ['role' => $td->id]) }}"
                                                   class="btn btn-sm"
                                                   id="btnNew{{ $td->id }}"
                                                   variant="outline-primary">
                                                <i class="fa fa-check-square"></i>
                                            </b-btn>
                                            <b-tooltip target="btnNew{{ $td->id }}"
                                                       title="Permissões com este Perfil">
                                            </b-tooltip>
                                        @endshield
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ trans('list.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection