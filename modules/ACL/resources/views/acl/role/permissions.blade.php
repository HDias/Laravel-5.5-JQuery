@if ($errors->has('permissions_id'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('permissions_id') }}
    </div>
@endif

@foreach($permissions as $title => $permission)
    @if ($loop->first)
        <div class="row mb-4">
            @endif
            <div class="col-3">

                <div class="card {{ isCardInvalid($errors, 'permissions_id') }}">
                    <div class="card-header">
                        <div class="form-check">
                            <input name="{{ $title }}" type="checkbox" class="form-check-input father">
                            <label class="form-check-label">{!! transAcl('readable_name',  $title . '.' . 'title', true) !!}</label>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($permission as $id => $values)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <div class="form-check">
                                                <input name="permissions_id[]"
                                                       type="checkbox"
                                                       class="form-check-input son"
                                                       {{ isset($role) ? isChecked($id, $role->permissions()->pluck('id')->toArray()) : false }}
                                                       value="{{$id}}">
                                                <label class="form-check-label">{!! transAcl('readable_name',  $title . '.' . $values['class'], true)  !!}</label>
                                                @if (Defender::hasRole(config('defender.superuser_role')))
                                                    <label class="form-check-label"><strong>({!! transAcl('readable_name',  $title . '.' . $values['class'])  !!}
                                                            )</strong></label>
                                                @endif
                                            </div>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if (($loop->iteration % 4) == 0)
        </div>
        <div class="row  mb-4">
            @endif
            @if ($loop->last)
        </div>
    @endif
@endforeach