@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <div class="card-header">

                <h5 class="title"><strong>Lista</strong> de Logs</h5>

            </div>
            <div class="card-body">

                <nut-paginator :per-page="{{ json_encode(app('request')->input("per_page")) }}" data-route="{{ url()->current() }}"></nut-paginator>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Model</th>
                            <th scope="col">Ação</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Valores Antigos</th>
                            <th scope="col">Novos Valores</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($logs as $data)
                            <tr>
                                <td>{!! getId($data->id, $loop->iteration) !!}</td>
                                <td>{{ $data->auditable_type }} (id: {{ $data->auditable_id }})</td>
                                <td>{{ $data->event }}</td>
                                <td>{{ $data->userName() }} (id: {{ $data->user_id }})</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    {{ $data->old_values }}
                                    {{--<table class="table">--}}
                                        {{--@foreach($data->old_values as $attribute => $value)--}}
                                            {{--<tr>--}}
                                                {{--<td><b>{{ $attribute }}</b></td>--}}
                                                {{--<td>{{ $value }}</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                    {{--</table>--}}
                                </td>
                                <td>
                                    {{ $data->new_values  }}
                                    {{--<table class="table">--}}
                                        {{--@foreach($data->new_values as $attribute => $value)--}}
                                            {{--<tr>--}}
                                                {{--<td><b>{{ $attribute }}</b></td>--}}
                                                {{--<td>{{ $value }}</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                    {{--</table>--}}
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">{{ trans('list.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{
                        $logs->appends([
                            'per_page' => app('request')->input("per_page"),
                        ])->links('vendor.pagination.bootstrap-4')
                     }}
                </div>
            </div>
        </div>
    </div>
@endsection