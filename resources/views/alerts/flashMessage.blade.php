@if (session('alert'))

    <div class="container-fluid">
        {{-- Se for em dev (local) tira o type do alert --}}
        @if (isEnv('local'))

            <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
                <p>{!! session('alert')['message']  !!}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @elseif(isset($envDisabled) && $envDisabled)

            <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
                <p>{!! session('alert')['message']  !!}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @else
            <b-alert :show="2"
                     dismissible
                     variant="{{ session('alert')['type'] }}"
                     @dismissed="0">
                <p>{!! session('alert')['message'] !!}</p>
            </b-alert>
        @endif
    </div>
@endif

@if (!empty(session('csrf_error')))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('csrf_error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    {{--<div id="card-alert" class="card orange lighten-5 center">--}}
        {{--<div class="card-content orange-text">--}}
            {{--<p>{{ session('csrf_error') }}</p>--}}
        {{--</div>--}}
        {{--<button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">--}}
            {{--<span aria-hidden="true">×</span>--}}
        {{--</button>--}}
    {{--</div>--}}
@endif
