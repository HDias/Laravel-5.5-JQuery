<nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top" id="mainNav">
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
            <ul class="navbar-nav">

                <li class="nav-item {{ menuActive(['dashboard.index'], Route::currentRouteName(), 3) }}" 
                    data-toggle="tooltip"
                    data-placement="right" 
                    title="Dashboard">
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
        <ul class="navbar-nav ml-auto">
            @if (!Auth::guest())
                <li class="nav-item" 
                    data-toggle="tooltip"
                    data-placement="right" 
                    title="Editar Perfil">

                    <a class="nav-link" 
                        href="{{ route('user.edit_logged') }}"
                        >
                        <i class="fa fa-fw fa-user"></i>
                    {{ \Auth::user()->name }} |
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-center" 
                        id="logout-button" 
                        data-toggle="modal"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Sair</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

