<nav class="navbar navbar-expand-lg navbar-blue bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand d-none d-sm-block" href="{{ route('home') }}">
        <img class="img-logo" src="/img/logo.png">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <i class="fa fa-bars text-white" aria-hidden="true"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        @if (!Auth::guest())
            <ul class="navbar-nav navbar-sidenav pt-4" id="exampleAccordion">

                <li class="nav-item {{ menuActive(['home'], Route::currentRouteName(), 3) }}" data-toggle="tooltip"
                    data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Painel</span>
                    </a>
                </li>

                @if (hasPermission(['group.index', 'group.create', 'group.edit']))
                    <li class="nav-item {{ menuActive(['group.index', 'group.create', 'group.edit'], Route::currentRouteName(), 3) }}"
                        data-toggle="tooltip" data-placement="right" title="Grupos">
                        <a class="nav-link" href="{{ route('group.index') }}">
                            <i class="fa fa-fw fa-users"></i>
                            <span class="nav-link-text">Grupos</span>
                        </a>
                    </li>
                @endif

                @if (hasPermission(['log.index']))
                    <li class="nav-item {{ menuActive(['audit.log.index'], Route::currentRouteName(), 3) }}"
                        data-toggle="tooltip" data-placement="right" title="Student">
                        <a class="nav-link" href="{{ route('audit.log.index') }}">
                            <i class="fa fa-fw fa-user-secret"></i>
                            <span class="nav-link-text">Auditoria</span>
                        </a>
                    </li>
                @endif

                @include('layouts.nav.acl')

                {{--@include('layouts.nav.config')--}}

            </ul>
        @endif
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @if (!Auth::guest())
                <li class="nav-item text-white">
                    <p class="navbar-text">
                        <a href="{{ route('user.edit_logged') }}" style="text-decoration: none; color: white">
                            <i class="fa fa-fw fa-user"></i>
                        {{ \Auth::user()->name }} |
                        </a>
                    </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="logout-button" data-toggle="modal" data-target="#exampleModal"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-sign-out"></i>Sair</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

