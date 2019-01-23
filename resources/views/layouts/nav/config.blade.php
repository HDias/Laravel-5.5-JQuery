@if (hasPermission(['select.option.index', 'select.option.create', 'select.option.edit']))
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="ACL">
        <a class="nav-link nav-link-collapse" data-toggle="collapse"
           href="#collapseConfig" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cog"></i>
            <span class="nav-link-text">Configurações</span>
        </a>
        <ul class="sidenav-second-level collapse {{ menuActive(['select.option.index', 'select.option.create', 'select.option.edit'], Route::currentRouteName(), 2) }}"
            id="collapseConfig">

            @if (hasPermission(['select.option.index', 'select.option.create', 'select.option.edit']))
                <li class="{{ menuActive(['select.option.index', 'select.option.create', 'select.option.edit'], Route::currentRouteName(), 3) }}">
                    <a class="nav-link" href="{{ route('select.option.index') }}">
                        <i class="fa fa-fw fa-arrow-right"></i>
                        <span class="nav-link-text">Opções para Select</span>
                    </a>
                </li>
            @endif

        </ul>
    </li>
@endif