@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <h5 class="card-header"><strong>Lista </strong> de Permissões</h5>
            <div class="card-body">

                <nut-paginator :per-page="{{ json_encode(app('request')->input("per_page")) }}" data-route="{{ url()->current() }}"></nut-paginator>

                <div class="table-responsive">
                    <table class="table table-striped table-hover datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Nome Para Leitura</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($permissions as $td)
                            <tr>
                                <td>{!! getId($td->id, $loop->iteration) !!}</td>
                                <td>{!! transAcl('name', $td->name, true)!!} ({!! $td->name !!})</td>
                                <td>{!! transAcl('readable_name',  $td->name, true) !!} ({!! $td->readable_name !!})
                                </td>
                                <td nowrap>

                                    @shield('acl.permission.edit')
                                        <a href="{{ route('acl.permission.edit', ['id' => $td->id]) }}"
                                           class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
                                        </a>
                                    @endshield

                                    @shield('acl.role.index')
                                        <b-btn href="{{ route('acl.role.index', ['permission' => $td->id]) }}"
                                               class="btn btn-sm"
                                               id="btnRole{{ $td->id }}"
                                               variant="outline-primary">
                                            <i class="fa fa-check-square"></i>
                                        </b-btn>
                                        <b-tooltip target="btnRole{{ $td->id }}"
                                                   title="Perfis com esta Permissão.">
                                        </b-tooltip>
                                    @endshield

                                    {{--<b-btn href="#"--}}
                                    {{--class="btn btn-sm"--}}
                                    {{--id="btnUser{{ $td->id }}"--}}
                                    {{--variant="primary"><i class="fa fa-users"></i></b-btn>--}}
                                    {{--<b-tooltip target="btnUser{{ $td->id }}" title="Usuários com esta Permissão."></b-tooltip>--}}

                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">{{ trans('list.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{
                        $permissions->appends([
                            'per_page' => app('request')->input("per_page"),
                        ])->links('vendor.pagination.bootstrap-4')
                     }}
                </div>
            </div>
        </div>
    </div>
@endsection