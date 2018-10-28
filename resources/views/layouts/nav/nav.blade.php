<nav class="navbar navbar-expand-lg navbar-blue bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand d-none d-sm-block" href="{{ route('home') }}">
        {{ config('app.name') }}
    </a>
    <button class="navbar-toggler navbar-toggler-right" 
        type="button" 
        data-toggle="collapse"
        data-target="#navbarResponsive" 
        aria-controls="navbarResponsive" 
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <i class="fa fa-bars text-white" aria-hidden="true"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        @if (!Auth::guest())
            <ul class="navbar-nav" id="exampleAccordion">

                <li class="nav-item {{ menuActive(['dashboard.index'], Route::currentRouteName(), 3) }}" data-toggle="tooltip"
                    data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Painel</span>
                    </a>
                </li>

                {{--@if (hasPermission(['group.index', 'group.create', 'group.edit']))
                    <li class="nav-item {{ menuActive(['group.index', 'group.create', 'group.edit'], Route::currentRouteName(), 3) }}"
                        data-toggle="tooltip" data-placement="right" title="Grupos">
                        <a class="nav-link" href="{{ route('group.index') }}">
                            <i class="fa fa-fw fa-users"></i>
                            <span class="nav-link-text">Grupos</span>
                        </a>
                    </li>
                @endif--}}

                @include('layouts.nav.acl')

                {{--@include('layouts.nav.config')--}}

            </ul>
        @endif
    </div>
</nav>

