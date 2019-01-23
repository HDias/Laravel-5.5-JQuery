@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card mb-4 card-shadow-6">
            <div class="card-header">

                <h5 class="title"><strong>Lista</strong> de Opções</h5>

                <div class="pull-right">
                    <a href="{{ route('select.option.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> {{ trans('forms.button_female_new') }}
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Label</th>
                            <th scope="col">Ordem</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($options as $data)
                            <tr>
                                <td>{!! getId($data->id, $loop->iteration) !!}</td>
                                <td>{!! $data->description !!}</td>
                                <td>{!! $data->slug !!}</td>
                                <td>{!! $data->label !!}</td>
                                <td>{!! $data->order !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('select.option.edit', ['id' => $data->id]) }}"
                                       class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                                    <nut-trash-btn href="{{ route('select.option.destroy', $data->id) }}"
                                                   data-id="{{ $data->id }}"></nut-trash-btn>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5">{{ trans('list.empty') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection